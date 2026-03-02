# React Router DOM

## Установка

```bash
npm install react-router-dom
```

---

## Основное использование

### 1. Обернуть приложение в `BrowserRouter`

```jsx
// main.jsx / index.jsx
import { BrowserRouter } from "react-router-dom";
import App from "./App";

ReactDOM.createRoot(document.getElementById("root")).render(
  <BrowserRouter>
    <App />
  </BrowserRouter>
);
```

### 2. Настроить маршруты (`Routes` + `Route`)

```jsx
// App.jsx
import { Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import About from "./pages/About";
import User from "./pages/User";
import NotFound from "./pages/NotFound";

function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/about" element={<About />} />
      <Route path="/user/:id" element={<User />} />
      <Route path="*" element={<NotFound />} />
    </Routes>
  );
}
```

### 3. Навигация — `Link` и `NavLink`

```jsx
import { Link, NavLink } from 'react-router-dom'

// Обычная ссылка
<Link to="/about">О нас</Link>

// Ссылка с активным состоянием (добавляет класс "active")
<NavLink to="/about" style={({ isActive }) => ({ color: isActive ? 'red' : 'black' })}>
  О нас
</NavLink>
```

### 4. Программная навигация — `useNavigate`

```jsx
import { useNavigate } from "react-router-dom";

function Login() {
  const navigate = useNavigate();

  const handleLogin = () => {
    // ... логика
    navigate("/dashboard"); // перейти
    navigate(-1); // назад
    navigate("/home", { replace: true }); // без записи в историю
  };
}
```

### 5. Параметры URL — `useParams`

```jsx
import { useParams } from "react-router-dom";

// Route: /user/:id
function User() {
  const { id } = useParams();
  return <h1>Пользователь: {id}</h1>;
}
```

### 6. Query-параметры — `useSearchParams`

```jsx
import { useSearchParams } from "react-router-dom";

// URL: /search?q=react&page=2
function Search() {
  const [searchParams, setSearchParams] = useSearchParams();
  const query = searchParams.get("q"); // "react"
  const page = searchParams.get("page"); // "2"
}
```

### 7. Вложенные маршруты + `Outlet`

```jsx
// App.jsx
<Routes>
  <Route path="/dashboard" element={<Dashboard />}>
    <Route path="stats" element={<Stats />} />
    <Route path="settings" element={<Settings />} />
  </Route>
</Routes>;

// Dashboard.jsx
import { Outlet } from "react-router-dom";

function Dashboard() {
  return (
    <div>
      <h1>Dashboard</h1>
      <Outlet /> {/* здесь рендерятся вложенные страницы */}
    </div>
  );
}
```

---

## Шпаргалка

| Что нужно                    | Что использовать       |
| ---------------------------- | ---------------------- |
| Обернуть приложение          | `<BrowserRouter>`      |
| Объявить маршруты            | `<Routes>` + `<Route>` |
| Ссылка                       | `<Link to="">`         |
| Ссылка с активным классом    | `<NavLink>`            |
| Перейти программно           | `useNavigate()`        |
| Получить `:id` из URL        | `useParams()`          |
| Получить `?key=value`        | `useSearchParams()`    |
| Место для дочерних маршрутов | `<Outlet>`             |
