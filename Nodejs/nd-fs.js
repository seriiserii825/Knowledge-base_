const filePath = path.join(process.cwd(), "data", "feedback.json");
const fileData = fs.readFileSync(filePath, "utf-8");
const data = JSON.parse(fileData);
data.push({ user: user, email: email });
fs.writeFileSync(filePath, JSON.stringify(data));

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
fs.stat("foo.txt", function (err, stat) {
  if (err == null) {
    console.log("File exists");
  } else if (err.code === "ENOENT") {
    // file does not exist
    fs.writeFile("log.txt", "Some log\n");
  } else {
    console.log("Some other error: ", err.code);
  }
});
