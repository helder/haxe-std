const fs = require("fs");
const version = JSON.parse(fs.readFileSync(".haxerc")).version;
fs.writeFileSync(
  "build/js/package.json",
  JSON.stringify({
    type: "module",
    name: "helder.std",
    version: `${version}-sources`,
    repository: "https://github.com/helder/std",
    license: "MIT",
  }, null, '  ')
);
