import {StringBuf} from "../../StringBuf"

/**
An implementation of JSON printer in Haxe.

This class is used by `haxe.Json` when native JSON implementation
is not available.

@see https://haxe.org/manual/std-Json-encoding.html
*/
export declare class JsonPrinter {
	protected constructor(replacer: ((key: any, value: any) => any), space: string)
	protected buf: StringBuf
	protected replacer: (key: any, value: any) => any
	protected indent: string
	protected pretty: boolean
	protected nind: number
	protected ipad(): void
	protected newl(): void
	protected write(k: any, v: any): void
	protected classString(v: any): void
	protected objString(v: any): void
	protected fieldsString(v: any, fields: string[]): void
	protected quote(s: string): void
	
	/**
	Encodes `o`'s value and returns the resulting JSON string.
	
	If `replacer` is given and is not null, it is used to retrieve
	actual object to be encoded. The `replacer` function takes two parameters,
	the key and the value being encoded. Initial key value is an empty string.
	
	If `space` is given and is not null, the result will be pretty-printed.
	Successive levels will be indented by this string.
	*/
	static print(o: any, replacer?: null | ((key: any, value: any) => any), space?: null | string): string
}

//# sourceMappingURL=JsonPrinter.d.ts.map