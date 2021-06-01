const path = require('path')

const fileNameAbs = __filename; //absolute path to file
const fileName = path.basename(__filename); // file name
const fileDirName = path.dirname(__filename); // abs path to dir  name of file
const extFileName = path.extname(__filename); // extension
const fileObj = path.parse(__filename); // object of file
const dirname = __dirname; // absolute path to dirname
const createUrl = path.join(__dirname, 'test', 'second.html'); // create a string url
const createUrlResolve = path.resolve(__dirname, 'test', '/second.html'); // create a right string url

