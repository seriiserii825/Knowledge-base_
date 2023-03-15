async function processArray(array) {
  for (const item of array) {
    await delayedLog(item);
  }
  console.log('Done!');
}
