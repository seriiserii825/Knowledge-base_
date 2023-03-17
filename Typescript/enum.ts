function compute() {
  return 4;
}

enum StatusCode {
  SUCCESS = 1,
  IN_PROCESS = 2,
  FAILED = compute(),
}

const res = {
  message: "Payment success",
  status: StatusCode.SUCCESS,
};

if (res.status === StatusCode.SUCCESS) {
  console.log("some");
}

// constant enum
const enum Roles {
  ADMIN,
  USER,
}

const res2 = Roles.ADMIN;

//-==================== Practice
async function getFaqs(req) {
  const res = await fetch("/faqs", {
    method: "POST",
    body: JSON.stringify(req),
  });
  const data = await res.json();
  return data;
}

// ==================== Result
enum QuestionStatus {
  published = "published",
  draft = "draft",
  deleted = "deleted",
}
async function getFaqs2({
  topicId: string,
  status: QuestionStatus,
}): Promise<
  {
    question: string;
    answer: string;
    tags: [];
    likes: number;
    status?: QuestionStatus;// ? - optional
  }[]
> {
  const res = await fetch("/faqs", {
    method: "POST",
    body: JSON.stringify(req),
  });
  const data = await res.json();
  return data;
}
