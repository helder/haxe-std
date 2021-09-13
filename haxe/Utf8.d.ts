
/**
Since not all platforms guarantee that `String` always uses UTF-8 encoding, you
can use this cross-platform API to perform operations on such strings.
*/
export declare class Utf8 {
	constructor(size?: null | number)
	protected __b: string
	
	/**
	Add the given UTF8 character code to the buffer.
	*/
	addChar(c: number): void
	
	/**
	Returns the buffer converted to a String.
	*/
	toString(): string
	
	/**
	Call the `chars` function for each UTF8 char of the string.
	*/
	static iter(s: string, chars: ((arg0: number) => void)): void
	
	/**
	Encode the input ISO string into the corresponding UTF8 one.
	*/
	static encode(s: string): string
	
	/**
	Decode an UTF8 string back to an ISO string.
	Throw an exception if a given UTF8 character is not supported by the decoder.
	*/
	static decode(s: string): string
	
	/**
	Similar to `String.charCodeAt` but uses the UTF8 character position.
	*/
	static charCodeAt(s: string, index: number): number
	
	/**
	Tells if the String is correctly encoded as UTF8.
	*/
	static validate(s: string): boolean
	
	/**
	Compare two UTF8 strings, character by character.
	*/
	static compare(a: string, b: string): number
	
	/**
	This is similar to `String.substr` but the `pos` and `len` parts are considering UTF8 characters.
	*/
	static sub(s: string, pos: number, len: number): string
}

//# sourceMappingURL=Utf8.d.ts.map