const fs = require("fs");
const libVersion = JSON.parse(fs.readFileSync("haxelib.json")).version;
const haxeVersion = JSON.parse(fs.readFileSync(".haxerc")).version;
fs.writeFileSync(
  "build/js/package.json",
  JSON.stringify({
    type: "module",
    name: "helder.std",
    version: `${haxeVersion}-${libVersion}`,
    repository: "https://github.com/helder/std",
    license: "MIT",
  }, null, '  ')
);
