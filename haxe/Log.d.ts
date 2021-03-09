import {PosInfos} from "./PosInfos"

/**
Log primarily provides the `trace()` method, which is invoked upon a call to
`trace()` in Haxe code.
*/
export declare class Log {
	
	/**
	Format the output of `trace` before printing it.
	*/
	static formatOutput(v: any, infos: PosInfos): string
	
	/**
	Outputs `v` in a platform-dependent way.
	
	The second parameter `infos` is injected by the compiler and contains
	information about the position where the `trace()` call was made.
	
	This method can be rebound to a custom function:
	
	var oldTrace = haxe.Log.trace; // store old function
	haxe.Log.trace = function(v, ?infos) {
	// handle trace
	}
	...
	haxe.Log.trace = oldTrace;
	
	If it is bound to null, subsequent calls to `trace()` will cause an
	exception.
	*/
	static trace(v: any, infos?: null | PosInfos): void
}

//# sourceMappingURL=Log.d.ts.map