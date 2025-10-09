import { z } from "zod";

// Валидная модель того, что мы хотим получить
export const PersonSchema = z.object({
  name: z.string(),
  age: z.number(),
});

// Тип берём из схемы — всегда синхронен с валидацией
export type Person = z.infer<typeof PersonSchema>;

async function fetchJSON(url: string): Promise<unknown> {
  const res = await fetch(url);

  // базовые проверки сети/статуса
  if (!res.ok) {
    throw new Error(`HTTP ${res.status} for ${url}`);
  }
  // необязательно, но полезно: проверим тип контента
  const ct = res.headers.get("content-type") || "";
  if (!ct.includes("application/json")) {
    throw new Error(`Expected JSON, got ${ct}`);
  }
  return res.json(); // <- unknown, не any
}

/**
 * Безопасный fetch с проверкой схемой.
 * Если сервер "сломал контракт", сразу бросит ошибку.
 */
export async function fetchWithSchema<T>(url: string, schema: z.ZodType<T>): Promise<T> {
  const data = await fetchJSON(url);
  // Бросит ZodError, если форма данных не совпадает
  return schema.parse(data);
}

const PeopleSchema = z.array(PersonSchema);

export async function getPeople(): Promise<Person[]> {
  return fetchWithSchema<Person[]>("/api/people", PeopleSchema);
}

(async () => {
  const ppl = await getPeople(); // <- гарантированно Person[]
  // здесь уже полноценный тип, автодополнение и проверки
  console.log(ppl[0].name.toUpperCase());
})();
