import {Bytes} from "./io/Bytes"

/**
Resource can be used to access resources that were added through the
`--resource file@name` command line parameter.

Depending on their type they can be obtained as `String` through
`getString(name)`, or as binary data through `getBytes(name)`.

A list of all available resource names can be obtained from `listNames()`.
*/
export declare class Resource {
	protected static content: {data: string, name: string, str: string}[]
	
	/**
	Lists all available resource names. The resource name is the name part
	of the `--resource file@name` command line parameter.
	*/
	static listNames(): string[]
	
	/**
	Retrieves the resource identified by `name` as a `String`.
	
	If `name` does not match any resource name, `null` is returned.
	*/
	static getString(name: string): string
	
	/**
	Retrieves the resource identified by `name` as an instance of
	haxe.io.Bytes.
	
	If `name` does not match any resource name, `null` is returned.
	*/
	static getBytes(name: string): Bytes
}

//# sourceMappingURL=Resource.d.ts.map