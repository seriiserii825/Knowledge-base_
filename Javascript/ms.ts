const s = 1000;
const m = s * 60;
const h = m * 60;
const d = h * 24;
const w = d * 7;
const y = d * 365.25;

type Unit =
  | "Years"
  | "Year"
  | "Yrs"
  | "Yr"
  | "Y"
  | "Weeks"
  | "Week"
  | "W"
  | "Days"
  | "Day"
  | "D"
  | "Hours"
  | "Hour"
  | "Hrs"
  | "Hr"
  | "H"
  | "Minutes"
  | "Minute"
  | "Mins"
  | "Min"
  | "M"
  | "Seconds"
  | "Second"
  | "Secs"
  | "Sec"
  | "S"
  | "Milliseconds"
  | "Millisecond"
  | "Msecs"
  | "Msec"
  | "Ms";

type UnitAnyCase = Unit | Uppercase<Unit> | Lowercase<Unit>;

export type StringValue = `${number}` | `${number}${UnitAnyCase}` | `${number} ${UnitAnyCase}`;

export function ms(str: StringValue): number {
  if (typeof str !== "string" || str.length === 0 || str.length > 100) {
    throw new Error("Value provided to ms() must be a string with length between 1 and 99.");
  }

  const match =
    /^(?<value>-?(?:\d+)?\.?\d+) *(?<type>milliseconds?|msecs?|ms|seconds?|secs?|s|minutes?|mins?|m|hours?|hrs?|h|days?|d|weeks?|w|years?|yrs?|y)?$/i.exec(
      str,
    );

  const groups = match?.groups as { value: string; type?: string } | undefined;

  if (!groups) {
    return NaN;
  }

  const n = parseFloat(groups.value);

  const type = (groups.type || "ms").toLowerCase() as Lowercase<Unit>;

  switch (type) {
    case "years":
    case "year":
    case "yrs":
    case "yr":
    case "y":
      return n * y;

    case "weeks":
    case "week":
    case "w":
      return n * w;

    case "days":
    case "day":
    case "d":
      return n * d;

    case "hours":
    case "hour":
    case "hrs":
    case "hr":
    case "h":
      return n * h;

    case "minutes":
    case "minute":
    case "mins":
    case "min":
    case "m":
      return n * m;

    case "seconds":
    case "second":
    case "secs":
    case "sec":
    case "s":
      return n * s;

    case "milliseconds":
    case "millisecond":
    case "msecs":
    case "msec":
    case "ms":
      return n;
  }
}

// ms('500') // 500
// ms('500ms') // 500
//
// ms('1s') // 1000
// ms('5sec') // 5000
// ms('10seconds') // 10000
//
// ms('1m') // 60000
// ms('5min') // 300000
// ms('15 minutes') // 900000
//
// ms('1h') // 3600000
// ms('2hrs') // 7200000
// ms('24 hours') // 86400000
//
// ms('1d') // 86400000
// ms('7days') // 604800000
//
// ms('1w') // 604800000
// ms('2weeks') // 1209600000
//
// ms('1y') // 31557600000
// ms('2years') // 63115200000
//
// ms('1.5h') // 5400000
// ms('0.5d') // 43200000
//
// ms('-5m') // -300000
