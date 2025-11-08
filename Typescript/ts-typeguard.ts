import { isPet, isRobot, TEntity } from "../types/pet-robot-types";

export default function petRobot() {
  function parseEntities(input: unknown): TEntity[] {
    if (!Array.isArray(input)) return [];
    const result: TEntity[] = [];
    input.forEach((entity) => {
      if (isPet(entity) || isRobot(entity)) {
        result.push(entity);
      }
    });
    return result;
  }
  function describeEntity(e: TEntity): string {
    let result = "";
    switch (e.type) {
      case "pet":
        result = `Питомец ${e.name} (${e.species}), возраст ${e.age} лет`;
        break;

      case "robot":
        result = `Робот ${e.model} v${e.version}, автономный: ${e.autonomous ? "да" : "нет"}`;
        break;

      default:
        const _exhaustive: never = e;
        return _exhaustive;
    }
    return result;
  }
  // 5️⃣ Пример теста
  const data: unknown[] = [
    { type: "pet", name: "Барсик", species: "cat", age: 3 },
    { type: "robot", model: "R2-D2", version: 2, autonomous: true },
    { type: "robot", model: "", version: -1 }, // невалидно
  ];
  const valid = parseEntities(data);
  for (const e of valid) {
    console.log(describeEntity(e));
  }
}

// pet-robot-types.ts
import { isBoolean, isNonEmptyString, isPositiveNumber, isRecord } from "../helpert/utils";

export type TPetType = "cat" | "dog" | "bird";

export type TPet = {
  type: "pet";
  name: string; // непустая строка
  species: TPetType;
  age: number; // больше 0
};

const species: TPetType[] = ["cat", "dog", "bird"] as const;

export function isValidSpecie(x: unknown): x is TPetType {
  return typeof x === "string" && (species as readonly string[]).includes(x as TPetType);
}

export type TRobot = {
  type: "robot";
  model: string; // непустая строка
  version: number; // положительное число
  autonomous?: boolean; // необязательное булево
};

export type TEntity = TPet | TRobot;

export function isPet(o: unknown): o is TPet {
  if (!isRecord(o)) return false;
  return (
    o.type === "pet" &&
    isNonEmptyString(o.name) &&
    isValidSpecie(o.species) &&
    isPositiveNumber(o.age)
  );
}

export function isRobot(o: unknown): o is TRobot {
  if (!isRecord(o)) return false;
  return (
    o.type === "robot" &&
    isNonEmptyString(o.model) &&
    isPositiveNumber(o.version) &&
    (o.autonomous === undefined || isBoolean(o.autonomous))
  );
}

// utils.ts

export function isRecord(v: unknown): v is Record<string, unknown> {
  // TODO: объект без null и не массив
  return typeof v === "object" && v !== null && !Array.isArray(v);
}
export function isNonEmptyString(x: unknown): x is string {
  // TODO: строка с .trim().length > 0
  return typeof x === "string" && x.trim().length > 0;
}
export function isPositiveNumber(x: unknown): x is number {
  // TODO: number finite > 0
  return typeof x === "number" && Number.isFinite(x) && x > 0;
}
export function isBoolean(x: unknown): x is boolean {
  return typeof x === "boolean";
}
