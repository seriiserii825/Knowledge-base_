function chunkArray(arr, n) {
  const chunkLength = Math.max(arr.length / n, 1);
  const chunks = [];
  for (var i = 0; i < n; i++) {
    if (chunkLength * (i + 1) <= arr.length) chunks.push(arr.slice(chunkLength * i, chunkLength * (i + 1)));
  }
  return chunks;
}
