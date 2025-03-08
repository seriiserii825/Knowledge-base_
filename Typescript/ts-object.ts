type TConfig = {
  status: string;
}

type TGetMoreInfo = (config: TConfig) => { data: number };

type O13 = {
  name: string;
  age: number;
  hasJob: boolean;
  getNumber?: () => number;
  getMoreInfo?: TGetMoreInfo;
}

const o13: O13[] = [
  {
    name: "John",
    age: 25,
    hasJob: true,
    getMoreInfo: (config: TConfig) => {
        return { data: 134344 };
    },
  },
  {
    name: "Alex",
    age: 28,
    hasJob: false,
    getNumber: function () {
        return 123;
    }
  },
];
