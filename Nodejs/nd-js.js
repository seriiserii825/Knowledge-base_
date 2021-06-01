fs.mkdir(path.join(__dirname, "notes"), (err) => {
  if (err) throw err;
});

fs.writeFile(
  path.join(__dirname, "notes", "mynotes.txt"),
  "Some content",
  (err) => {
    if (err) throw err;
  }
);

fs.appendFile(
  path.join(__dirname, "notes", "mynotes.txt"),
  "From append file",
  (err) => {
    if (err) throw err;
    console.log("file was updated");
  }
);

fs.readFile(
  path.join(__dirname, "notes", "mynotes.txt"),
  "utf-8",
  (err, data) => {
    if (err) throw err;
    console.log(data, "data");
  }
);

fs.rename(
  path.join(__dirname, "notes", "mynotes.txt"),
  path.join(__dirname, "notes", "notes.txt"),
  (err) => {
    if (err) throw err;
  }
);
