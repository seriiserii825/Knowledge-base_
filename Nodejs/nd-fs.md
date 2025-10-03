# fs

## Enhanced File Operations

```bash

Copy: fs.copy(src, dest): Copies directories and files, including nested contents, from the source to the destination.
Move: fs.move(src, dest): Transfers folders and files, providing an option to rename them.
Remove: fs.remove(path): Deletes folders and files recursively.
```

## Directory Operations

```bash

Ensure Directory: fs.ensureDir(path): Verifies if a directory already exists; if not, creates the directory.
Empty Directory: fs.emptyDir(path): Deletes a directory's contents but leaves the directory itself intact.
Ensure File: fs.ensureFile(path): Verifies if a file already exists; if not, creates the file.
```

## JSON Handling

```bash

Read JSON: fs.readJson(path): Reads a JSON file and parses its content.
Write JSON: fs.writeJson(path, data): Writes a JavaScript object to a file as JSON.
```

## Promise Support

```bash

Promise-Based API: Most methods return Promises, making writing asynchronous code with the async/await syntax easier.
```

## Convenience Methods

```bash

Output File: fs.outputFile(path, data): Creates directories if none already exist and writes data to a file.
Output JSON: fs.outputJson(path, data): Creates folders if none already exist before writing a JavaScript object in JSON to a file.
Read File: fs.readFile(path): Reads the content of a file.
Write File: fs.writeFile(path, data): Writes data to a file.
Path Exists: fs.pathExists(path): Checks if a file or directory exists at the given path.
```

## Create Symbolic Links

```bash

Ensure Symlink: fs.ensureSymlink(srcpath, dstpath): Verifies whether a symbolic link is present, and if not, creates one.
```

## example

```javascript
// Asynchronous function to perform various file operations
async function performFileOperations() {
  try {
    // Ensure a directory exists; create it if it doesn't
    await fs.ensureDir('exampleDir');
    // Create a file and write some data to it
    await fs.outputFile('exampleDir/exampleFile.txt', 'Hello, world!');
    // Read the file's content
    const data = await fs.readFile('exampleDir/exampleFile.txt', 'utf-8');
    console.log('File Content:', data);
    // Recursively copy the file
    await fs.copy('exampleDir/exampleFile.txt', 'exampleDir/copyOfExampleFile.txt');
    // Move the file to a new location
    await fs.move('exampleDir/copyOfExampleFile.txt', 'exampleDir/movedExampleFile.txt');
    // Remove the file
    await fs.remove('exampleDir/movedExampleFile.txt');
    // Ensure a file exists; create it if it doesn't
    await fs.ensureFile('exampleDir/newFile.txt');
    // Write JSON data to a file
    const jsonData = { name: 'John Doe', age: 30 };
    await fs.writeJson('exampleDir/data.json', jsonData);
    // Read JSON data from a file
    const jsonFileContent = await fs.readJson('exampleDir/data.json');
    console.log('JSON File Content:', jsonFileContent);
  } catch (err) {
    console.error('Error during file operations:', err);
  }
}
```
