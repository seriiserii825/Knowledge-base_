# Паттерн валидации многокомпонентной формы: Vue 3 + Pinia + Zod v4

Документация к паттерну, применённому в проекте `vue-gm-impianti-assistenza`.

---

## Проблема

В одностраничном приложении с многошаговой формой инпуты разбросаны по нескольким компонентам (`ContactDetails.vue`, `ServiceDetails.vue` и т.д.), а кнопка отправки находится в отдельном `SubmitForm.vue`. Нужно:

- показывать ошибки **рядом с каждым полем**
- запускать валидацию **только при нажатии «Отправить»**
- **сразу убирать** ошибку поля, когда пользователь начинает его редактировать
- не переусложнять архитектуру (без provide/inject, без prop drilling через несколько уровней)

---

## Решение: ошибки живут в store

Вся форма уже управляется через Pinia store. Туда же добавляются ошибки — это логично, т.к. store уже является единственным источником истины для данных формы.

```
Pinia Store
  данные формы (vat, customer_details, service_details…)
  validation_errors: Record<string, string>   ← плоский объект {поле: сообщение}
  validateForm(): boolean
  clearError(field: string): void
        │
        ├── ContactDetails.vue   → читает errors, передаёт :error в FormInput
        ├── ServiceDetails.vue   → читает errors, передаёт :error в FormTextarea
        └── SubmitForm.vue       → вызывает validateForm() перед отправкой
```

`FormInput` и `FormTextarea` остаются **generic** — они просто получают строку `error` пропсом и ничего не знают ни о store, ни о Zod.

---

## Структура файлов

```
src/
├── validation/
│   └── homeSchema.ts       # Zod-схемы
├── stores/
│   └── homeStore.ts        # данные + validation_errors + validateForm()
└── components/
    ├── form/
    │   ├── FormInput.vue       # + error prop
    │   └── FormTextarea.vue    # + error prop
    └── home/
        ├── ContactDetails.vue  # читает errors из store
        ├── ServiceDetails.vue  # читает errors из store
        └── SubmitForm.vue      # вызывает validateForm()
```

---

## Шаг 1 — Установка

```bash
bun add zod
# или
npm install zod
```

> **Zod v4:** используй `z.email()` как top-level функцию.
> `z.string().email()` устарел (deprecated) в v4.

---

## Шаг 2 — Схемы (`src/validation/homeSchema.ts`)

```ts
import { z } from 'zod'

// Базовая схема контактных данных
export const contactDetailsSchema = z.object({
  company_name: z.string().min(1, 'Ragione sociale obbligatoria'),
  address:      z.string().min(1, 'Indirizzo obbligatorio'),
  phone:        z.string().min(1, 'Telefono obbligatorio'),
  email:        z.email("Inserire un'email valida"),  // ← z.email(), не .string().email()
})

// Новый клиент — VAT тоже обязателен
export const newClientFormSchema = contactDetailsSchema.extend({
  vat:             z.string().min(1, 'Partita IVA / Codice fiscale obbligatorio'),
  service_details: z.string().min(1, 'Descrivere il problema riscontrato'),
})

// Существующий клиент — VAT уже проверен через API, не валидируем
export const existingClientFormSchema = contactDetailsSchema.extend({
  service_details: z.string().min(1, 'Descrivere il problema riscontrato'),
})
```

**Почему два варианта схемы?**
Для существующего клиента VAT проверяется отдельным API-запросом до появления формы — нет смысла валидировать его повторно при отправке.

---

## Шаг 3 — Store (`src/stores/homeStore.ts`)

```ts
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { newClientFormSchema, existingClientFormSchema } from '@/validation/homeSchema'

export const useHomeStore = defineStore('home', () => {
  // --- существующие данные формы ---
  const client_type = ref<null | 'new' | 'existing'>(null)
  const isNewClient = computed(() => client_type.value === 'new')

  const vat = ref<string | null>(null)
  const customer_details = ref({ company_name: '', address: '', phone: '', email: '' })
  const service_details = ref('')

  // --- валидация ---
  const validation_errors = ref<Record<string, string>>({})

  function validateForm(): boolean {
    const schema = isNewClient.value ? newClientFormSchema : existingClientFormSchema

    const data = {
      vat: vat.value ?? '',
      ...customer_details.value,
      service_details: service_details.value,
    }

    const result = schema.safeParse(data)

    if (result.success) {
      validation_errors.value = {}
      return true
    }

    // Flatten: { fieldErrors: { company_name: ['...'], ... } }
    // → превращаем в плоский { company_name: '...' }
    const flat = result.error.flatten().fieldErrors
    validation_errors.value = Object.fromEntries(
      Object.entries(flat).map(([key, messages]) => [key, messages?.[0] ?? ''])
    )
    return false
  }

  function clearError(field: string) {
    if (validation_errors.value[field]) {
      delete validation_errors.value[field]
    }
  }

  return {
    // данные
    client_type, isNewClient, vat, customer_details, service_details,
    // валидация
    validation_errors, validateForm, clearError,
  }
})
```

**Ключевые моменты:**
- `safeParse` вместо `parse` — не бросает исключение, возвращает `{ success, error }`
- `.flatten().fieldErrors` даёт объект `{ fieldName: string[] }` — берём первое сообщение `[0]`
- При успехе `validation_errors` сбрасывается в `{}`

---

## Шаг 4 — FormInput и FormTextarea

Добавить `error` пропс и рендер сообщения об ошибке:

```vue
<!-- FormInput.vue -->
<script setup lang="ts">
defineProps({
  // ... существующие пропсы ...
  error: { type: String, required: false, default: '' },
})
</script>

<template>
  <div class="form-input">
    <label v-if="label" :for="name">{{ label }}</label>
    <input :id="name" v-model="value" :name="name" :type="type" :placeholder="placeholder" />
    <p v-if="error" class="form-input__error">{{ error }}</p>
  </div>
</template>
```

То же самое для `FormTextarea.vue` — добавить пропс `error` и `<p v-if="error" class="form-textarea__error">`.

---

## Шаг 5 — Компоненты с инпутами

### ContactDetails.vue

```vue
<script setup lang="ts">
import { ref, watch } from 'vue'
import { storeToRefs } from 'pinia'
import { useHomeStore } from '@/stores/homeStore'

const home_store = useHomeStore()
const { validation_errors } = storeToRefs(home_store)

const form = ref({ company_name: '', address: '', phone: '', email: '' })
const local_vat = ref('')

// Очищаем ошибку, как только пользователь начинает редактировать поле
watch(() => form.value.company_name, () => home_store.clearError('company_name'))
watch(() => form.value.address,      () => home_store.clearError('address'))
watch(() => form.value.phone,        () => home_store.clearError('phone'))
watch(() => form.value.email,        () => home_store.clearError('email'))
watch(local_vat,                     () => home_store.clearError('vat'))
</script>

<template>
  <FormInput
    v-model="form.company_name"
    name="company_name"
    label="Ragione sociale*"
    :error="validation_errors['company_name']"
  />
  <!-- VAT только для нового клиента (v-if="!customerDetails") -->
  <FormInput
    v-if="!customerDetails"
    v-model="local_vat"
    name="vat"
    label="Partita IVA*"
    :error="validation_errors['vat']"
  />
  <FormInput
    v-model="form.address"
    name="address"
    label="Indirizzo*"
    :error="validation_errors['address']"
  />
  <FormInput
    v-model="form.phone"
    name="phone"
    label="Telefono*"
    :error="validation_errors['phone']"
  />
  <FormInput
    v-model="form.email"
    name="email"
    type="email"
    label="E-mail*"
    :error="validation_errors['email']"
  />
</template>
```

### ServiceDetails.vue

```vue
<script setup lang="ts">
import { watch } from 'vue'
import { storeToRefs } from 'pinia'
import { useHomeStore } from '@/stores/homeStore'

const home_store = useHomeStore()
const { service_details, validation_errors } = storeToRefs(home_store)

watch(service_details, () => home_store.clearError('service_details'))
</script>

<template>
  <FormTextarea
    v-model="service_details"
    name="service_details"
    label="Descriva il problema*"
    :error="validation_errors['service_details']"
  />
</template>
```

---

## Шаг 6 — SubmitForm.vue

```vue
<script setup lang="ts">
import { ref } from 'vue'
import { useHomeStore } from '@/stores/homeStore'

const home_store = useHomeStore()
const accepted = ref(false)
const is_loading = ref(false)

async function onSubmit() {
  if (!accepted.value) return

  // Запускаем валидацию — если не прошла, ошибки уже видны в компонентах выше
  const isValid = home_store.validateForm()
  if (!isValid) return

  try {
    is_loading.value = true
    await homeServiceApi.newTicket(/* payload */)
  } catch (error) {
    console.error(error)
  } finally {
    is_loading.value = false
  }
}
</script>
```

---

## Шаг 7 — Стили ошибок (SCSS)

```scss
// В blocks/form-input.scss и blocks/form-textarea.scss
.form-input__error,
.form-textarea__error {
  color: var(--error-color, #e53935); // или используй существующий токен
  font-size: 0.75rem;
  margin-top: 4px;
}
```

---

## Поведение итогового решения

| Сценарий | Результат |
|---|---|
| Пользователь нажимает «Invia» с пустыми полями | Все ошибки появляются инлайн у каждого поля |
| Пользователь начинает вводить текст в поле с ошибкой | Ошибка этого поля сразу исчезает |
| Все поля заполнены корректно | `validateForm()` возвращает `true`, уходит API-запрос |
| Существующий клиент (VAT проверен через API) | Поле VAT отсутствует, `existingClientFormSchema` не проверяет его |

---

## Почему не другие подходы?

| Подход | Почему не выбран |
|---|---|
| `vuelidate` / `vee-validate` | Внешняя зависимость, своя API. Zod уже есть в проекте |
| `provide` / `inject` ошибок | Неявная связь, сложнее дебажить |
| Ошибки как пропсы через все уровни | Prop drilling через `NewClientForm → ContactDetails → FormInput` |
| Валидация в каждом компоненте отдельно | Схема разбросана, нет единого места где видно все правила |
| `FormInput` читает ошибки напрямую из store | Компонент становится coupled к конкретному store — нельзя переиспользовать |

**Ключевое правило:** `FormInput` и `FormTextarea` — **generic**, принимают `error` строкой. Store — **единственный источник** и данных, и ошибок. Компоненты-секции — **связующее звено** между ними.
