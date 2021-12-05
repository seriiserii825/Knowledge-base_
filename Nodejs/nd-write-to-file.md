const fs = require('fs');
const array = fs.readFileSync('2.5.txt').toString().split("\n");
const newArray = [];

array.forEach(item => {
    const elem = `${item}|${item}`;
    newArray.push(elem);
});
newArray.forEach(item => {
    console.log(item, 'item')
});

const writeStream = fs.createWriteStream('file-2.5.txt');
const pathName = writeStream.path;

// write each value of the array on the file breaking line
newArray.forEach(value => writeStream.write(`${value}\n`));

// the finish event is emitted when all data has been flushed from the stream
writeStream.on('finish', () => {
    console.log(`wrote all the array data to file ${pathName}`);
});

// handle the errors on the write process
writeStream.on('error', (err) => {
    console.error(`There is an error writing the file ${pathName} => ${err}`)
});

// close the stream
writeStream.end();
