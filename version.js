const fs = require("fs");
const version = JSON.parse(fs.readFileSync(".haxerc")).version;
console.log(version);