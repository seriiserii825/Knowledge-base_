import { z } from "zod";

const PersonSchema = z.object({
  name: z.string(),
  age: z.number(),
});

const response = await fetch("/api/people");
const data = await response.json();

// Runtime-проверка
const ppl = PersonSchema.array().parse(data); // если структура неверна — выбросит ошибку

// Теперь TypeScript знает, что ppl — Person[]
ppl[0].name;


