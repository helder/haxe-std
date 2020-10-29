const fs = require("fs");
const libVersion = JSON.parse(fs.readFileSync("haxelib.json")).version;
const haxeVersion = JSON.parse(fs.readFileSync(".haxerc")).version;
console.log(`${haxeVersion}-${libVersion}`);