type Success = {
  res: "success";
  data: string;
};

type Fail = {
  res: "fail";
  errorMessage: string;
};

type ResType = Success | Fail;

function isResSuccess(res: ResType): res is Success {
  return res.res === "success";
}

function process(res: ResType) {
  if (isResSuccess(res)) {
    // res is Success
  } else {
    // res is Fail
  }
}

// lang ========================
const SUPPORTED_LANGS = ["en", "es", "fr"] as const;
type SupportedLang = (typeof SUPPORTED_LANGS)[number];

export const isSupportedLang = (lang: unknown): lang is SupportedLang => {
  return (
    typeof lang === "string" && SUPPORTED_LANGS.includes(lang as SupportedLang)
  );
};

// Usage
export const getSupportedLang = (language?: string): SupportedLang => {
  if (isSupportedLang(language)) {
    return language;
  }
  return "en";
};

type Id = string | number;

// function
function swapIdType(id: Id) {
  if (typeof id === "string") {
    // id is string
  } else {
    // id is number
  }
}

// Types
type User = {
  type: "user";
  id: Id;
  name: string;
};

type Admin = {
  type: "admin";
  id: Id;
  role: string;
};

function logDetails(value: User | Admin) {
  if (value.type === "user") {
    // value is User
  } else {
    // value is Admin
  }
}
