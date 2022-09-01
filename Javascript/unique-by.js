function getUniqueBy(arr, prop) {
  const set = new Set();
  return arr.filter((o) => !set.has(o[prop]) && set.add(o[prop]));
}

clients = getUniqueBy(clients, "client_id");

# by 2 properties
const uniqueAgents = filteredAgents.filter(function (a) {
    var key = a.nome + '|' + a.cognome;
    if (!this[key]) {
        this[key] = true;
        return true;
    }
}, Object.create(null));
