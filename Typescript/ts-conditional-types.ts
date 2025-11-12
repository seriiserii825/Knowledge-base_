export default function conditionalType() {
  type GetFirstType<T> = T extends Array<infer U> ? U : never;
  type Ex = GetFirstType<string[]>; // string
  type Ex2 = GetFirstType<number[]>; // number
  type Ex3 = GetFirstType<boolean>; // never

  interface IDataFromUser {
    weight: string;
  }
  interface IDataFromDB {
    calories: number;
  }

  type FromUserOrDB<T extends string | number> = T extends string ? IDataFromUser : IDataFromDB;

  const dataFromUser: FromUserOrDB<string> = {
    weight: "70kg",
  };

  interface User<T extends "created" | Date> {
    created: T extends "created" ? "created" : Date;
  }

  const user1: User<"created"> = {
    created: "created",
  };
  const user2: User<Date> = {
    created: new Date(),
  };

  function calculateDailyCalories(num_or_string: string): IDataFromUser;
  function calculateDailyCalories(num_or_string: number): IDataFromDB;
  function calculateDailyCalories(num_or_string: number | string): IDataFromUser | IDataFromDB {
    if (typeof num_or_string === "string") {
      const obj: IDataFromUser = {
        weight: num_or_string,
      };
      return obj;
    } else {
      const obj: IDataFromDB = {
        calories: num_or_string,
      };
      return obj;
    }
  }

  // type FromUserOrDB<T extends string | number> = T extends string ? IDataFromUser : IDataFromDB;
  // // function calculateDailyCalories(num_or_string: string): IDataFromUser;
  // // function calculateDailyCalories(num_or_string: number): IDataFromDB;
  // function calculateDailyCalories<T extends string | number>(
  //   num_or_string: T,
  // ): T extends string ? IDataFromUser : IDataFromDB {
  //   if (typeof num_or_string === "string") {
  //     const obj: IDataFromUser = {
  //       weight: num_or_string,
  //     };
  //     return obj as FromUserOrDB<T>;
  //   } else {
  //     const obj: IDataFromDB = {
  //       calories: num_or_string,
  //     };
  //     return obj as FromUserOrDB<T>;
  //   }
  // }

  const str = calculateDailyCalories("70kg")
  const num = calculateDailyCalories(2500)
}
