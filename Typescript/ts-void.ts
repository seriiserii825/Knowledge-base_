function saveUserName(value: string, onSaved: VoidFunction) {
// function saveUserName(value: string, onSaved: () => void) {
  fetch('http://example.com', {
    method: 'POST',
    body: JSON.stringify({ value })
  }).then(() => {
    // void is expected
    const data = onSaved();
    data.some(); // Error: Property 'some' does not exist on type 'void'.
  });
}

saveUserName("John", () => {
  console.log("saved");
});

saveUserName('Chris', () => {
  return 'saved'; // void is expected
})
