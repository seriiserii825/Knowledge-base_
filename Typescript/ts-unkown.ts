const my_json = '{"name": "Alice", "age": 30}';

function parseJSON(json: string): unknown {
  return JSON.parse(json);
}

const data: unknown = parseJSON(my_json);
if (typeof data === "object" && data !== null) {
  if ("name" in data && typeof data.name === "string") {
    console.log(`Name: ${data.name}`);
  } else {
    console.log("Name property is missing or not a string.");
  }
}
