# Angular Authentication — Access Token + Refresh Token + Guard + Interceptor

## Архитектура

Используем:

- `accessToken` — хранится в памяти Angular в `AuthService`
- `refreshToken` — хранится в `HttpOnly Cookie`
- `AuthService` — login / register / refresh / logout / хранение access token
- `Auth Guard` — защищает приватные routes (всё из `pages/auth/`)
- `HTTP Interceptor` — добавляет Bearer token и обрабатывает `401`
- `NestJS` — проверяет JWT
- `returnUrl` — возвращает пользователя на исходную страницу после login
- `API_URL` / `PUBLIC_URL` / `DASHBOARD_URL` — все URL берём из конфигов, не хардкодим строками

---

# 1. Структура

```text
src/app/
├── core/
│   ├── auth/
│   │   └── auth.service.ts
│   │
│   ├── guards/
│   │   └── auth.guard.ts
│   │
│   └── interceptors/
│       └── auth.interceptor.ts
│
├── components/
│   └── forms/
│       └── login-form/          ← login() + returnUrl
│
├── layouts/
│   ├── main-layout/
│   └── auth-layout/             ← layout страницы логина
│
├── pages/
│   ├── auth/                    ← ТОЛЬКО авторизованные страницы, все под guard'ом
│   │   └── dashboard-page/
│   │
│   ├── login-page/              ← публичная, поэтому НЕ внутри auth/
│   ├── google-callback-page/
│   └── home-page/
│
├── shared/
│   └── config/
│       ├── api.config.ts        ← API_URL (backend)
│       └── url.config.ts        ← ROUTE, PUBLIC_URL, DASHBOARD_URL (frontend)
│
├── app.config.ts
└── app.routes.ts
```

Правило:

```text
pages/auth/    = нужен логин → guard
pages/*        = публичные страницы
```

Страница логина лежит снаружи `auth/`: если бы guard висел и на ней, неавторизованный пользователь не смог бы на неё попасть (см. п. 33).

---

# 2. URL-конфиги

`src/app/shared/config/api.config.ts` — адреса backend:

```ts
export const SERVER_URL = import.meta.env['NG_APP_SERVER_URL']

export const API_URL = {
  root: (url = '') => `${SERVER_URL}${url}`,
  auth: (url = '') => API_URL.root(`/auth${url}`),
  login: () => API_URL.auth('/login'),
  register: () => API_URL.auth('/register'),
  refreshToken: () => API_URL.auth('/login/access-token'),
  logout: () => API_URL.auth('/logout'),
  // ...
}
```

`src/app/shared/config/url.config.ts` — адреса страниц Angular:

```ts
export const ROUTE = {
  login: 'login',
  dashboard: 'dashboard',
  // ...
} as const

export const PUBLIC_URL = {
  root: (url = '') => `/${url}`,
  home: () => PUBLIC_URL.root(),
  login: () => PUBLIC_URL.root(ROUTE.login), // → /login
  // ...
}

export const DASHBOARD_URL = {
  root: (url = '') => `/${ROUTE.dashboard}${url}`,
  home: () => DASHBOARD_URL.root(), // → /dashboard
  favorites: () => DASHBOARD_URL.root('/favorites'), // → /dashboard/favorites
}
```

ВАЖНО:

```text
API_URL.*     → запросы к NestJS  (http://server/auth/login)
PUBLIC_URL.*  → навигация Angular (/login)
```

Не путать: `router.navigate` получает `PUBLIC_URL`, `http.post` получает `API_URL`.

Грабли, которые уже ловили:

```text
'/api/auth/refresh'          ← относительный путь
↓
запрос уходит на dev-сервер Angular (localhost:4200), а не на SERVER_URL
↓
404 → refresh всегда "падает" → после F5 всегда выкидывает на login
```

```text
router.createUrlTree([ROUTE.login])   ← 'login' — это сегмент, а не полный URL
↓
когда login был вложен (/auth/login), получался /login → Cannot match any routes
```

Поэтому всегда `PUBLIC_URL.login()`, а не `ROUTE.login` / строка.

---

# 3. AuthService

`src/app/core/auth/auth.service.ts`

```ts
import { HttpClient } from '@angular/common/http'
import { Injectable, inject } from '@angular/core'

import { Observable, tap } from 'rxjs'

import { API_URL } from '@/shared/config/api.config'
import { IAuthForm, IAuthResponse } from '@/shared/types/IAuth'

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private http = inject(HttpClient)

  // Access token хранится только в памяти Angular
  private accessToken: string | null = null

  login(data: IAuthForm) {
    return this.http.post<IAuthResponse>(API_URL.login(), data, { withCredentials: true }).pipe(
      tap(({ accessToken }) => {
        this.accessToken = accessToken
      })
    )
  }

  register(data: IAuthForm) {
    return this.http.post<IAuthResponse>(API_URL.register(), data, { withCredentials: true }).pipe(
      tap(({ accessToken }) => {
        this.accessToken = accessToken
      })
    )
  }

  refresh(): Observable<{ accessToken: string }> {
    return this.http
      .post<{ accessToken: string }>(API_URL.refreshToken(), {}, { withCredentials: true })
      .pipe(
        tap(({ accessToken }) => {
          this.accessToken = accessToken
        })
      )
  }

  // HTTP-запрос на backend (удаляет refresh cookie).
  // Возвращает Observable — без subscribe() ничего не произойдёт!
  logout() {
    return this.http.post(API_URL.logout(), {}, { withCredentials: true }).pipe(
      tap(() => {
        this.accessToken = null
      })
    )
  }

  setAccessToken(token: string): void {
    this.accessToken = token
  }

  getAccessToken(): string | null {
    return this.accessToken
  }

  // Синхронно забывает token в памяти, без HTTP
  clearAccessToken(): void {
    this.accessToken = null
  }

  isAuthenticated(): boolean {
    return !!this.accessToken
  }
}
```

`withCredentials: true` — нужен, чтобы браузер отправил/принял HttpOnly cookie с refreshToken при запросе на другой origin (`SERVER_URL`).

---

# 4. logout() vs clearAccessToken()

```text
logout()
= POST /auth/logout → backend удаляет refresh cookie
= Observable, ЛЕНИВЫЙ: без .subscribe() запрос не уйдёт и token не очистится

clearAccessToken()
= просто this.accessToken = null
= синхронно, без HTTP
```

Где что использовать:

```text
Кнопка "Выйти"                → logout().subscribe(...)
Interceptor: refresh упал     → clearAccessToken()
```

Почему в interceptor НЕ `logout()`:

```text
authService.logout()        ← без subscribe
↓
ничего не происходит (Observable холодный)
↓
token остаётся в памяти
```

А если подписаться — сам logout-запрос пойдёт через interceptor, получит 401 и снова вызовет refresh. Поэтому в interceptor только `clearAccessToken()`.

---

# 5. Что делает isAuthenticated()

```ts
isAuthenticated(): boolean {
  return !!this.accessToken
}
```

Он проверяет только наличие access token:

```text
null
↓
false


"eyJhbGciOi..."
↓
true
```

ВАЖНО:

Он не проверяет, expired JWT или нет.

Например:

```text
accessToken = "eyJhbGci..."

токен существует
↓
isAuthenticated() === true

но токен может быть expired
```

Expiration окончательно проверяет backend.

Если NestJS получает expired access token:

```text
NestJS
↓
401 Unauthorized
```

После этого `Interceptor` делает refresh.

---

# 6. Auth Guard

`src/app/core/guards/auth.guard.ts`

```ts
import { inject } from '@angular/core'
import { CanActivateFn, Router } from '@angular/router'

import { catchError, map, of } from 'rxjs'

import { AuthService } from '@/core/auth/auth.service'
import { PUBLIC_URL } from '@/shared/config/url.config'

export const authGuard: CanActivateFn = (_route, state) => {
  const authService = inject(AuthService)
  const router = inject(Router)

  // Access token уже есть в памяти
  if (authService.isAuthenticated()) {
    return true
  }

  // Access token отсутствует.
  //
  // Например:
  // пользователь сделал F5.
  //
  // Пробуем восстановить access token
  // через HttpOnly refresh cookie.

  return authService.refresh().pipe(
    map(() => true),

    catchError(() => {
      return of(
        router.createUrlTree([PUBLIC_URL.login()], {
          queryParams: {
            returnUrl: state.url,
          },
        })
      )
    })
  )
}
```

`CanActivateFn` подходит и для `canActivate`, и для `canActivateChild` — сигнатура `(route, state)` одинаковая.

---

# 7. Как работает Guard

Пользователь открывает:

```text
/dashboard
```

Angular запускает:

```text
authGuard
```

Дальше:

```text
/dashboard
    ↓
authGuard
    ↓
accessToken существует?
    │
 ┌──┴───┐
 │      │
YES     NO
 │       │
true   refresh()
 │       │
 ▼    ┌──┴─────┐
page  200      401
       │        │
       ▼        ▼
     true     /login?returnUrl=/dashboard
```

---

# 8. returnUrl

Если пользователь хотел открыть:

```text
/dashboard/favorites
```

но refresh token уже expired, Guard делает:

```ts
router.createUrlTree([PUBLIC_URL.login()], {
  queryParams: {
    returnUrl: state.url,
  },
})
```

`state.url`:

```text
/dashboard/favorites
```

Angular отправит пользователя на:

```text
/login?returnUrl=%2Fdashboard%2Ffavorites
```

После успешного login можно вернуть пользователя обратно.

---

# 9. LoginForm

Login делается не в странице, а в компоненте формы:

`src/app/components/forms/login-form/login-form.ts`

```ts
import { HttpErrorResponse } from '@angular/common/http'
import { Component, inject, output, signal } from '@angular/core'
import { ActivatedRoute, Router } from '@angular/router'

import { AuthService } from '@/core/auth/auth.service'
import { DASHBOARD_URL } from '@/shared/config/url.config'

@Component({
  // ...
  selector: 'app-login-form',
  templateUrl: './login-form.html',
})
export class LoginForm {
  private authService = inject(AuthService)
  private router = inject(Router)
  private route = inject(ActivatedRoute)

  email = signal('')
  password = signal('')

  errorMessage = signal<string | null>(null)
  isSubmitting = signal(false)

  onSubmit(event: Event) {
    event.preventDefault()
    this.errorMessage.set(null)
    this.isSubmitting.set(true)

    this.authService
      .login({
        name: '',
        email: this.email(),
        password: this.password(),
      })
      .subscribe({
        next: () => {
          this.isSubmitting.set(false)
          const returnUrl = this.route.snapshot.queryParamMap.get('returnUrl')

          this.router.navigateByUrl(returnUrl || DASHBOARD_URL.home())
        },
        error: (error: HttpErrorResponse) => {
          this.isSubmitting.set(false)
          const message = error.error?.message || 'An error occurred during login.'
          this.errorMessage.set(message)
        },
      })
  }
}
```

`ActivatedRoute` внутри компонента формы указывает на route страницы `/login`, поэтому `queryParamMap` видит `returnUrl`.

`navigateByUrl`, а не `navigate`: `returnUrl` — это уже готовая строка URL (`/dashboard/favorites`), её не надо разбивать на сегменты.

Получается:

```text
/dashboard/favorites
        ↓
Guard
        ↓
не авторизован
        ↓
/login?returnUrl=/dashboard/favorites
        ↓
Login
        ↓
200 OK
        ↓
returnUrl
        ↓
/dashboard/favorites
```

Если пользователь самостоятельно открыл:

```text
/login
```

то `returnUrl` будет:

```ts
null
```

и:

```ts
returnUrl || DASHBOARD_URL.home()
```

даст:

```text
/dashboard
```

---

# 10. Auth Interceptor

`src/app/core/interceptors/auth.interceptor.ts`

Interceptor:

1. Добавляет `Authorization: Bearer`
2. Ловит `401`
3. Пропускает 401 от login / register / refresh без refresh
4. Иначе делает refresh
5. Повторяет оригинальный запрос

```ts
import { HttpErrorResponse, HttpInterceptorFn } from '@angular/common/http'
import { inject } from '@angular/core'
import { Router } from '@angular/router'

import { catchError, switchMap, throwError } from 'rxjs'

import { AuthService } from '@/core/auth/auth.service'
import { API_URL } from '@/shared/config/api.config'
import { PUBLIC_URL } from '@/shared/config/url.config'

const withAuthHeader = (req: Parameters<HttpInterceptorFn>[0], token: string) =>
  req.clone({
    setHeaders: {
      Authorization: `Bearer ${token}`,
    },
  })

// На 401 от этих эндпоинтов refresh не делаем:
// login/register — неверные данные, refresh — иначе бесконечный цикл.
const SKIP_REFRESH_URLS = [API_URL.login(), API_URL.register(), API_URL.refreshToken()]

export const authInterceptor: HttpInterceptorFn = (req, next) => {
  const authService = inject(AuthService)
  const router = inject(Router)

  const token = authService.getAccessToken()

  // Добавляем access token к запросу
  const authReq = token ? withAuthHeader(req, token) : req

  return next(authReq).pipe(
    catchError((error: HttpErrorResponse) => {
      if (error.status !== 401) {
        return throwError(() => error)
      }

      if (SKIP_REFRESH_URLS.includes(req.url)) {
        return throwError(() => error)
      }

      // Access token expired.
      // Получаем новый.
      return authService.refresh().pipe(
        switchMap(({ accessToken }) => {
          // Повторяем оригинальный запрос
          // с новым access token.
          const retryReq = withAuthHeader(req, accessToken)

          return next(retryReq)
        }),

        catchError((refreshError) => {
          // Refresh token тоже expired / invalid
          authService.clearAccessToken()

          router.navigateByUrl(PUBLIC_URL.login())

          return throwError(() => refreshError)
        })
      )
    })
  )
}
```

---

# 11. SKIP_REFRESH_URLS — зачем

## refresh

Нельзя делать refresh самого refresh запроса:

```text
refresh → 401
↓
refresh
↓
401
↓
refresh
...
```

получится бесконечный цикл.

## login / register

`401` на `/auth/login` означает "неверный email/пароль", а не "token expired".

Без исключения:

```text
неверный пароль
↓
401
↓
Interceptor → refresh()
↓
refresh тоже 401 (cookie нет)
↓
redirect на /login + наружу летит ошибка REFRESH, а не login
↓
форма показывает не то сообщение
```

С исключением ошибка login уходит прямо в `error:` формы.

## Почему сравнение через `API_URL`, а не `includes('/auth/refresh')`

Строка `'/auth/refresh'` должна совпадать с реальным эндпоинтом (`/auth/login/access-token`). Если захардкодить — она тихо разъедется с backend, и исключение перестанет срабатывать. `API_URL.*()` — один источник правды для сервиса и interceptor'а.

---

# 12. Как работает Interceptor

Любой запрос:

```ts
this.http.get(API_URL.users())
```

проходит через interceptor:

```text
Component
    ↓
HttpClient
    ↓
Interceptor
    ↓
AuthService.getAccessToken()
    ↓
Authorization: Bearer <accessToken>
    ↓
NestJS
```

Реальный HTTP request:

```http
GET /user
Authorization: Bearer eyJhbGciOi...
```

---

# 13. Если accessToken expired

Например:

```text
accessToken существует
но expired
```

Guard этого не определяет:

```ts
isAuthenticated()
```

вернёт:

```ts
true
```

Пользователь открывает dashboard.

Затем приложение делает:

```ts
this.http.get(API_URL.users())
```

Interceptor добавляет старый token:

```http
GET /user
Authorization: Bearer OLD_TOKEN
```

NestJS отвечает:

```text
401 Unauthorized
```

Interceptor ловит `401`:

```text
GET /user
      ↓
Bearer OLD_TOKEN
      ↓
NestJS
      ↓
401
      ↓
Interceptor
      ↓
refresh()
      ↓
POST /auth/login/access-token
      ↓
NEW ACCESS TOKEN
      ↓
switchMap()
      ↓
повторить:
GET /user
Bearer NEW_TOKEN
      ↓
200 OK
```

Для пользователя всё происходит автоматически.

---

# 14. Если refreshToken expired

Например:

```text
accessToken  → 15 минут
refreshToken → 7 дней
```

Через 7 дней:

```text
API request
↓
accessToken expired
↓
401
↓
Interceptor
↓
POST /auth/login/access-token
↓
refreshToken expired
↓
401
↓
clearAccessToken()
↓
accessToken = null
↓
/login
```

Пользователь должен снова ввести email/password.

---

# 15. tap()

`tap()` выполняет side effect, но НЕ изменяет значение Observable.

Например:

```ts
tap(({ accessToken }) => {
  this.accessToken = accessToken
})
```

Было:

```ts
{
  accessToken: 'abc123'
}
```

Происходит:

```text
{ accessToken: "abc123" }
        ↓
       tap()
        ↓
this.accessToken = "abc123"
        ↓
{ accessToken: "abc123" }
```

Observable продолжает содержать тот же объект.

Поэтому `tap()` удобно использовать для:

```text
save state
console.log()
save token
side effects
```

---

# 16. map()

`map()` преобразует значение Observable.

Например:

```ts
map(() => true)
```

В Guard:

```ts
authService.refresh().pipe(map(() => true))
```

До `map`:

```ts
{
  accessToken: 'abc123'
}
```

После:

```ts
true
```

То есть:

```text
refresh()
↓
{ accessToken: "abc123" }
↓
tap()
↓
сохраняем token
↓
{ accessToken: "abc123" }
↓
map(() => true)
↓
true
↓
Guard разрешает route
```

---

# 17. switchMap()

`switchMap()` позволяет после одного Observable переключиться на другой Observable.

У нас:

```ts
authService.refresh().pipe(
  switchMap(({ accessToken }) => {
    return next(retryReq)
  })
)
```

Схема:

```text
refresh()
↓
new accessToken
↓
switchMap()
↓
новый HTTP request
↓
next(retryReq)
↓
API response
```

То есть после refresh мы не просто преобразуем данные, а запускаем новый HTTP request.

---

# 18. createUrlTree()

В Guard:

```ts
return router.createUrlTree([PUBLIC_URL.login()])
```

`createUrlTree()` сам по себе не выполняет навигацию.

Он создаёт описание:

```text
UrlTree
└── /login
```

Guard возвращает его Angular Router:

```text
Guard
↓
UrlTree('/login')
↓
Angular Router
↓
отменяет текущую навигацию
↓
открывает /login
```

Поэтому в Guard лучше:

```ts
return router.createUrlTree([PUBLIC_URL.login()])
```

чем:

```ts
router.navigateByUrl(PUBLIC_URL.login())
return false
```

В interceptor же `UrlTree` вернуть некому — там `router.navigateByUrl(...)` напрямую.

---

# 19. Routes

`app.routes.ts`

```ts
import { Routes } from '@angular/router'

import { authGuard } from '@/core/guards/auth.guard'
import { AuthLayout } from '@/layouts/auth-layout/auth-layout'
import { MainLayout } from '@/layouts/main-layout/main-layout'
import { ROUTE } from '@/shared/config/url.config'

export const routes: Routes = [
  // ==========================================
  // PUBLIC
  // ==========================================
  {
    path: '',
    component: MainLayout,
    children: [
      {
        path: '',
        loadComponent: () => import('@/pages/home-page/home-page').then((m) => m.HomePage),
      },
    ],
  },

  // ==========================================
  // LOGIN — публичный, БЕЗ guard'а
  // ==========================================
  {
    path: ROUTE.login,
    component: AuthLayout,
    children: [
      {
        path: '',
        loadComponent: () => import('@/pages/login-page/login-page').then((m) => m.LoginPage),
      },
    ],
  },

  // ==========================================
  // PRIVATE — только авторизованные страницы (pages/auth)
  // ==========================================
  {
    path: '',
    // Guard применяется ко всем children
    canActivateChild: [authGuard],
    children: [
      {
        path: ROUTE.dashboard,
        loadComponent: () =>
          import('@/pages/auth/dashboard-page/dashboard-page').then((m) => m.DashboardPage),
      },
      // новые приватные страницы добавлять сюда
    ],
  },

  // ==========================================
  // GOOGLE OAUTH CALLBACK (пока не доделан)
  // ==========================================
  {
    path: 'google-callback',
    loadComponent: () =>
      import('@/pages/google-callback-page/google-callback-page').then((m) => m.GoogleCallbackPage),
  },
]
```

Получаем URL:

```text
/                  → HomePage          (MainLayout)
/login             → LoginPage         (AuthLayout)
/dashboard         → DashboardPage     (authGuard)
/google-callback   → GoogleCallbackPage
```

Папки ↔ routes:

```text
pages/login-page/        ↔  /login        (публичный)
pages/auth/*             ↔  children группы с canActivateChild
```

---

# 20. Почему path: '' работает

Вот этот route:

```ts
{
  path: '',
  canActivateChild: [authGuard],

  children: [
    {
      path: 'dashboard',
      ...
    },
  ],
}
```

не добавляет ничего к URL и не имеет `component` (componentless route) — это просто группа.

Получаем:

```text
/dashboard
```

а НЕ:

```text
//dashboard
```

Первый route `path: ''` (MainLayout) тоже совпадает с `/dashboard` по префиксу, но его children (`''`) не совпадают с `dashboard` — Router откатывается и пробует следующий route. Поэтому две группы с `path: ''` уживаются.

Структура:

```text
path: ''
│
├── canActivateChild: authGuard
│
└── /dashboard
```

Если захочется префикс в URL (`/auth/dashboard`) — поменять `path: ''` на `path: 'auth'` (и `DASHBOARD_URL.root` соответственно).

---

# 21. canActivateChild

`canActivateChild` защищает children.

```ts
{
  path: '',
  canActivateChild: [authGuard],

  children: [
    {
      path: 'dashboard',
    },
    {
      path: 'profile',
    },
  ],
}
```

Получаем:

```text
/dashboard → authGuard
/profile   → authGuard
```

Если добавить:

```text
/settings
/orders
/users
```

они также автоматически будут защищены.

---

# 22. canActivate vs canActivateChild

## canActivate

Защищает route, на котором находится:

```ts
{
  path: 'dashboard',
  canActivate: [authGuard],
}
```

```text
/dashboard
    ↓
authGuard
```

## canActivateChild

Защищает children:

```ts
{
  path: '',
  canActivateChild: [authGuard],

  children: [
    {
      path: 'dashboard',
    },
    {
      path: 'profile',
    },
  ],
}
```

```text
/dashboard → guard
/profile   → guard
```

Для группы приватных страниц удобно использовать:

```ts
canActivateChild: [authGuard]
```

ВАЖНО: `canActivateChild` проверяет ВСЕХ children. Поэтому публичную страницу (login) нельзя класть в ту же группу (см. п. 33).

---

# 23. DashboardLayout (на будущее)

Сейчас приватная группа без layout. Когда понадобится общий header/sidebar для приватных страниц — добавить `component` в группу:

```ts
{
  path: '',
  component: DashboardLayout,
  canActivateChild: [authGuard],
  children: [ ... ],
}
```

```ts
import { Component } from '@angular/core'
import { RouterOutlet } from '@angular/router'

@Component({
  imports: [RouterOutlet],
  selector: 'app-dashboard-layout',
  templateUrl: './dashboard-layout.html',
})
export class DashboardLayout {}
```

`dashboard-layout.html`:

```html
<header>Dashboard Header</header>

<aside>Sidebar</aside>

<main>
  <router-outlet />
</main>
```

Angular будет рендерить:

```text
DashboardLayout
│
├── Header
├── Sidebar
│
└── router-outlet
       │
       ├── DashboardPage
       ├── ProfilePage
       └── SettingsPage
```

---

# 24. Google Callback

```text
/google-callback?accessToken=...
```

Лежит отдельно: не в `pages/auth/` (в момент callback'а access token'а в Angular ещё нет) и не под `AuthLayout`.

NestJS (`auth.controller.ts`) ставит refresh cookie и передаёт access token в query:

```ts
@Get('google/callback')
@UseGuards(AuthGuard('google'))
async googleAuthCallback(@Req() req: any, @Res({ passthrough: true }) res: Response) {
  const { refreshToken, ...response } = await this.authService.validateOAuthLogin(req)
  this.authService.addRefreshTokenToResponse(res, refreshToken)

  return res.redirect(
    `${this.configService.get('CLIENT_URL')}/google-callback?accessToken=${response.accessToken}`
  )
}
```

Angular (`pages/google-callback-page/google-callback-page.ts`):

```ts
ngOnInit() {
  const accessToken = this.route.snapshot.queryParamMap.get('accessToken')

  if (!accessToken) {
    this.router.navigateByUrl(PUBLIC_URL.login(), { replaceUrl: true })
    return
  }

  this.authService.setAccessToken(accessToken)

  // replaceUrl: URL с токеном не остаётся в истории браузера
  this.router.navigateByUrl(DASHBOARD_URL.home(), { replaceUrl: true })
}
```

Схема:

```text
Login with Google
↓
window.location.href = `${SERVER_URL}/auth/google`
↓
Google
↓
NestJS /auth/google/callback          ← это адрес в Google Console
↓
Set-Cookie: refreshToken (HttpOnly)
↓
redirect → CLIENT_URL/google-callback?accessToken=...
↓
GoogleCallbackPage
↓
authService.setAccessToken(...)
↓
/dashboard
```

ВАЖНО — два разных callback'а:

```text
Google → backend    SERVER_URL/auth/google/callback   (Authorized redirect URI в Google Console,
                                                        callbackURL в google.strategy.ts)
backend → Angular   CLIENT_URL/google-callback        (res.redirect в auth.controller.ts)
```

Google Console знает только про первый. Второй — обычный HTTP-редирект Nest'а, Google про него не знает.

---

# 25. Подключение Interceptor

`app.config.ts`

```ts
import { provideHttpClient, withInterceptors } from '@angular/common/http'
import { ApplicationConfig, provideBrowserGlobalErrorListeners } from '@angular/core'
import { provideRouter } from '@angular/router'

import { routes } from '@/app.routes'
import { authInterceptor } from '@/core/interceptors/auth.interceptor'

export const appConfig: ApplicationConfig = {
  providers: [
    provideBrowserGlobalErrorListeners(),
    provideRouter(routes),
    provideHttpClient(withInterceptors([authInterceptor])),
  ],
}
```

Interceptor подключается к `HttpClient`, а НЕ к routes.

---

# 26. Guard и Interceptor НЕ вызывают друг друга

Важно:

```text
Guard ≠ Interceptor
```

Guard не вызывает interceptor напрямую.

Interceptor не вызывает Guard.

Оба используют:

```text
AuthService
```

Архитектура:

```text
                   AuthService
                  /           \
                 /             \
                ▼               ▼
             Guard         Interceptor
               │               │
               │               │
        защищает routes    работает с HTTP
```

---

# 27. Но HTTP внутри Guard тоже проходит через Interceptor

Например Guard вызывает:

```ts
authService.refresh()
```

А внутри:

```ts
this.http.post(API_URL.refreshToken(), ...)
```

Поскольку это `HttpClient`, запрос технически проходит через interceptor.

Поэтому interceptor обязательно должен исключать refresh:

```ts
if (SKIP_REFRESH_URLS.includes(req.url)) {
  return throwError(() => error)
}
```

Иначе можно получить бесконечный refresh loop.

Ошибка refresh уходит обратно в Guard → его `catchError` → `UrlTree('/login?returnUrl=...')`.

---

# 28. Полный Login flow

```text
User
↓
/login
↓
email + password
↓
POST /auth/login
↓
NestJS
↓
проверяет credentials
↓
┌───────────────────────────────┐
│                               │
│ accessToken                   │
│ ↓                             │
│ response body                 │
│                               │
│ refreshToken                  │
│ ↓                             │
│ HttpOnly Cookie               │
│                               │
└───────────────────────────────┘
↓
Angular AuthService
↓
tap()
↓
this.accessToken = accessToken
↓
returnUrl || /dashboard
```

---

# 29. Обычный authenticated request

```text
Dashboard
↓
GET /user
↓
HttpClient
↓
Interceptor
↓
getAccessToken()
↓
Authorization:
Bearer <accessToken>
↓
NestJS
↓
JWT valid
↓
200 OK
```

---

# 30. Access token expired

```text
Dashboard
↓
GET /user
↓
Interceptor
↓
Bearer OLD_ACCESS_TOKEN
↓
NestJS
↓
JWT expired
↓
401
↓
Interceptor
↓
POST /auth/login/access-token
↓
HttpOnly refresh cookie
↓
NestJS
↓
refreshToken valid
↓
new accessToken
↓
AuthService
↓
tap()
↓
save new accessToken
↓
switchMap()
↓
retry original request
↓
GET /user
↓
Bearer NEW_ACCESS_TOKEN
↓
200 OK
```

---

# 31. F5 / Reload

До F5:

```text
AuthService
└── accessToken = "abc123"
```

После F5 Angular запускается заново:

```text
AuthService
└── accessToken = null
```

Но браузер всё ещё хранит:

```text
refreshToken
└── HttpOnly Cookie
```

Пользователь находится на:

```text
/dashboard
```

Guard:

```text
/dashboard
↓
authGuard
↓
accessToken === null
↓
refresh()
↓
POST /auth/login/access-token
↓
HttpOnly Cookie
↓
NestJS
↓
new accessToken
↓
tap()
↓
save accessToken
↓
map(() => true)
↓
Dashboard
```

---

# 32. Refresh token expired

Если:

```text
accessToken  = 15 min
refreshToken = 7 days
```

и прошло больше 7 дней:

```text
/dashboard
↓
Guard
↓
accessToken отсутствует
↓
refresh()
↓
refreshToken expired
↓
401
↓
createUrlTree()
↓
/login?returnUrl=/dashboard
```

Пользователь должен снова авторизоваться.

---

# 33. Грабли: guard на странице логина

Было (НЕПРАВИЛЬНО):

```ts
{
  path: 'auth',
  component: AuthLayout,
  canActivateChild: [authGuard],   // ← на всей группе
  children: [
    { path: 'login', ... },        // ← login тоже под guard'ом!
    { path: 'dashboard', ... },
  ],
}
```

Что происходит:

```text
неавторизованный → /auth/login
↓
authGuard
↓
refresh() → 401
↓
UrlTree('/auth/login')
↓
authGuard (снова!)
↓
...бесконечный редирект
```

Решение — то, что сейчас:

```text
pages/login-page/  → /login, без guard'а
pages/auth/*       → группа с canActivateChild
```

Guard вешаем только на то, что реально требует авторизации.

---

# 34. Кто за что отвечает

```text
AuthService
│
├── хранит accessToken
├── login() / register()
├── refresh()
├── logout()            ← HTTP, нужен subscribe
├── clearAccessToken()  ← синхронно
└── isAuthenticated()


Auth Guard
│
├── защищает private routes (pages/auth)
│
├── accessToken есть
│   └── true
│
└── accessToken нет
    ├── refresh success → true
    └── refresh error   → /login?returnUrl=...


HTTP Interceptor
│
├── перехватывает HTTP requests
│
├── добавляет:
│
│   Authorization:
│   Bearer <accessToken>
│
└── получает 401
    ├── login / register / refresh → просто пробрасывает ошибку
    └── остальное
        ├── refresh()
        ├── получает новый token
        ├── retry original request
        └── refresh упал → clearAccessToken() → /login


NestJS
│
├── проверяет accessToken
│
├── valid
│   └── разрешает API request
│
├── expired
│   └── 401
│
└── /auth/login/access-token
    ├── проверяет refreshToken
    ├── valid → новый accessToken
    └── expired → 401
```

---

# 35. Главная схема

```text
                        Angular
                           │
                           ▼
                    ┌─────────────┐
                    │ AuthService │
                    │             │
                    │ accessToken │
                    └──────┬──────┘
                           │
               ┌───────────┴───────────┐
               │                       │
               ▼                       ▼
        ┌─────────────┐          ┌─────────────┐
        │ Auth Guard  │          │ Interceptor │
        └──────┬──────┘          └──────┬──────┘
               │                        │
         protect routes           HTTP requests
               │                        │
               │                  Bearer token
               │                        │
               │                        ▼
               │                     NestJS
               │                        │
               │                  access valid?
               │                    │       │
               │                   YES      NO
               │                    │       │
               │                   200     401
               │                            │
               │                            ▼
               │                        refresh()
               │                            │
               │                            ▼
               └────────────► /auth/login/access-token
                                            │
                                            ▼
                                    HttpOnly Cookie
                                            │
                                            ▼
                                         NestJS
                                            │
                                  refreshToken valid?
                                      │           │
                                     YES          NO
                                      │           │
                                      ▼           ▼
                               new accessToken   401
                                      │           │
                                      ▼           ▼
                                  retry API     /login
```

---

# 36. TODO / можно улучшить

- **Параллельные 401.** Если одновременно упадут несколько запросов — каждый вызовет свой `refresh()`. Если backend ротирует refresh token, второй refresh получит 401 и выкинет пользователя. Решение: хранить один in-flight refresh (`shareReplay(1)`) и отдавать его всем.
- **Guest guard для `/login`.** Сейчас авторизованный пользователь может открыть `/login`. Можно сделать обратный guard: если `isAuthenticated()` → `UrlTree(DASHBOARD_URL.home())`.

---

# Главное запомнить

```text
Guard
=
можно ли открыть страницу?


Interceptor
=
что делать с HTTP request?


AuthService
=
где хранить token и как делать
login / refresh / logout?


pages/auth/
=
только приватные страницы
→ одна группа с canActivateChild


login
=
публичный, НЕ под guard'ом
иначе бесконечный редирект


URL
=
только через API_URL / PUBLIC_URL / DASHBOARD_URL,
никаких строк руками


accessToken
=
короткоживущий JWT
хранится в памяти Angular


refreshToken
=
долгоживущий token
хранится в HttpOnly Cookie


accessToken expired
=
Interceptor → refresh → retry


refreshToken expired
=
сессия закончилась → clearAccessToken() → /login


logout()
=
Observable, без subscribe не работает


F5
=
accessToken исчезает из памяти
→ Guard вызывает refresh
→ accessToken восстанавливается


returnUrl
=
запоминает страницу, которую
пользователь хотел открыть
→ после login возвращаем его туда
```
