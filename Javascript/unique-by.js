function getUniqueBy(arr, prop) {
  const set = new Set();
  return arr.filter((o) => !set.has(o[prop]) && set.add(o[prop]));
}

clients = getUniqueBy(clients, "client_id");
