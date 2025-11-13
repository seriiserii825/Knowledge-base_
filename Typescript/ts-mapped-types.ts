export default function mappedTypes() {
  type Keys = "name" | "age" | "location";
  type User = {
    [K in Keys]: string;
  };

  const alex: User = {
    name: "Alex",
    age: "30",
    location: "New York",
  };

  type Languages = {
    ru: "ru";
    en: "en";
    de: "de";
  };

  type MyLanguages = {
    [K in keyof Languages]: string;
  };

  type Class = {
    name: string;
    startsAt: string;
    duration: number;
  };

  //rename property
  type FutureClasses = Required<{
    [K in keyof Class as K extends "startsAt" ?  "willStartsAt" : K]: Class[K];
  }>;
}
