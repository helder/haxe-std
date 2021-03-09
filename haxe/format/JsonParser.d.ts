
/**
An implementation of JSON parser in Haxe.

This class is used by `haxe.Json` when native JSON implementation
is not available.

@see https://haxe.org/manual/std-Json-parsing.html
*/
export declare class JsonParser {
	
	/**
	Parses given JSON-encoded `str` and returns the resulting object.
	
	JSON objects are parsed into anonymous structures and JSON arrays
	are parsed into `Array<Dynamic>`.
	
	If given `str` is not valid JSON, an exception will be thrown.
	
	If `str` is null, the result is unspecified.
	*/
	static parse(str: string): any
}

//# sourceMappingURL=JsonParser.d.ts.map