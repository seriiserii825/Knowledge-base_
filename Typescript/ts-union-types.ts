export default function unionTypes() {
  type Currencies = {
    usa: "usd";
    china: "cnd";
    russia: "rub";
    moldova: "mdl";
  };
  type MyAnimation = "fadeIn" | "fadeOut";

  // types
  type CurrencyWithoutUsa = Omit<Currencies, "usa">; // исключение
  type CurrencyUsaAndRussia = Pick<Currencies, "usa" | "russia">; // фильтрация

  // union types
  type AnimationWithoutFadeOut = Exclude<MyAnimation, "fadeOut">; // исключение из union типа
  type CurrenciesExclude = Exclude<keyof Currencies, "china" | "moldova">; // исключение ключей

  type FadeInType = Extract<MyAnimation, "fadeIn">; // извлечение из union типа

  // record
  type CurrencyRecord = Record<keyof Currencies, number>; // создание объекта с ключами из типа Currencies и значениями типа number

  // record
  const currencyValues: CurrencyRecord = {
    usa: 1,
    china: 6.5,
    russia: 75,
    moldova: 17,
  };

  // 1. Record + Union как ключи
  type Status = "success" | "error" | "loading";

  const uiMessages: Record<Status, string> = {
    success: "Loaded!",
    error: "Something went wrong",
    loading: "Please wait...",
  };
  // 2. Union в значениях Record
  type Role = "admin" | "user" | "guest";

  const access: Record<string, Role> = {
    john: "admin",
    kate: "user",
    david: "guest",
  };
  // 3. Record + Union of objects
  type Product = { type: "book"; pages: number } | { type: "video"; duration: number };

  const items: Record<string, Product> = {
    "1001": { type: "book", pages: 250 },
    "1002": { type: "video", duration: 120 },
  };
  // 5. Частичный Record с union ключами (необязательно все)

  type Lang = "en" | "ru" | "it";

  const translations: Partial<Record<Lang, string>> = {
    en: "Hello",
    ru: "Привет",
    // it: не обязательно
  };
  // 6. Обязательные поля + union значений

  type Size = "S" | "M" | "L";

  type ProductInfo = Record<"name" | "price", string | number> & {
    size: Size;
  };

  const shirt: ProductInfo = {
    name: "T-Shirt",
    price: 20,
    size: "M",
  };
}
