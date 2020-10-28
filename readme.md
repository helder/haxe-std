# helder.std

Use external haxe std for php or js (using [genes](https://github.com/benmerckx/genes))

## usage

Install helder.std:

````
lix +lib helder.std
````

(Or using haxelib: `haxelib install helder.std`)

And use it in you build.hxml:

````
--library helder.std
````

This will exclude all of the Haxe std classes and add `@:native` metadata.
At runtime the classes will be loaded from one of the distributions below.

## php

Haxe 4.x std is published to [helder/std](https://packagist.org/packages/helder/std) (and available in [#php](https://github.com/helder/std/tree/php))

Install according to your haxe version:

````
composer require helder/std:4.1.4
````

## js

Haxe 4.x std is published to [helder.std](https://www.npmjs.com/package/helder.std) (and available in [#js](https://github.com/helder/std/tree/js))

Install according to your haxe version:

````
npm install helder.std@4.1.4
yarn add helder.std@4.1.4
````
