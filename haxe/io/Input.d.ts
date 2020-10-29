import {Encoding} from "./Encoding"
import {Bytes} from "./Bytes"

/**
An Input is an abstract reader. See other classes in the `haxe.io` package
for several possible implementations.

All functions which read data throw `Eof` when the end of the stream
is reached.
*/
export declare class Input {
	
	/**
	Endianness (word byte order) used when reading numbers.
	
	If `true`, big-endian is used, otherwise `little-endian` is used.
	*/
	bigEndian: boolean
	
	/**
	Read and return one byte.
	*/
	readByte(): number
	
	/**
	Read `len` bytes and write them into `s` to the position specified by `pos`.
	
	Returns the actual length of read data that can be smaller than `len`.
	
	See `readFullBytes` that tries to read the exact amount of specified bytes.
	*/
	readBytes(s: Bytes, pos: number, len: number): number
	
	/**
	Close the input source.
	
	Behaviour while reading after calling this method is unspecified.
	*/
	close(): void
	
	/**
	Read and return all available data.
	
	The `bufsize` optional argument specifies the size of chunks by
	which data is read. Its default value is target-specific.
	*/
	readAll(bufsize?: null | number): Bytes
	
	/**
	Read `len` bytes and write them into `s` to the position specified by `pos`.
	
	Unlike `readBytes`, this method tries to read the exact `len` amount of bytes.
	*/
	readFullBytes(s: Bytes, pos: number, len: number): void
	
	/**
	Read and return `nbytes` bytes.
	*/
	read(nbytes: number): Bytes
	
	/**
	Read a string until a character code specified by `end` is occurred.
	
	The final character is not included in the resulting string.
	*/
	readUntil(end: number): string
	
	/**
	Read a line of text separated by CR and/or LF bytes.
	
	The CR/LF characters are not included in the resulting string.
	*/
	readLine(): string
	
	/**
	Read a 32-bit floating point number.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readFloat(): number
	
	/**
	Read a 64-bit double-precision floating point number.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readDouble(): number
	
	/**
	Read a 8-bit signed integer.
	*/
	readInt8(): number
	
	/**
	Read a 16-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readInt16(): number
	
	/**
	Read a 16-bit unsigned integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readUInt16(): number
	
	/**
	Read a 24-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readInt24(): number
	
	/**
	Read a 24-bit unsigned integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readUInt24(): number
	
	/**
	Read a 32-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	readInt32(): number
	
	/**
	Read and `len` bytes as a string.
	*/
	readString(len: number, encoding?: null | Encoding): string
}

//# sourceMappingURL=Input.d.ts.map