
export declare class SysTools {
	
	/**
	Character codes of the characters that will be escaped by `quoteWinArg(_, true)`.
	*/
	static winMetaCharacters: number[]
	
	/**
	Returns a String that can be used as a single command line argument
	on Unix.
	The input will be quoted, or escaped if necessary.
	*/
	static quoteUnixArg(argument: string): string
	
	/**
	Returns a String that can be used as a single command line argument
	on Windows.
	The input will be quoted, or escaped if necessary, such that the output
	will be parsed as a single argument using the rule specified in
	http://msdn.microsoft.com/en-us/library/ms880421
	
	Examples:
	```haxe
	quoteWinArg("abc") == "abc";
	quoteWinArg("ab c") == '"ab c"';
	```
	*/
	static quoteWinArg(argument: string, escapeMetaCharacters: boolean): string
}

//# sourceMappingURL=SysTools.d.ts.map