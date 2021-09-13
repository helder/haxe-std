import {Input} from "./Input"
import {Encoding} from "./Encoding"
import {Bytes} from "./Bytes"

/**
An Output is an abstract write. A specific output implementation will only
have to override the `writeByte` and maybe the `write`, `flush` and `close`
methods. See `File.write` and `String.write` for two ways of creating an
Output.
*/
export declare class Output {
	
	/**
	Endianness (word byte order) used when writing numbers.
	
	If `true`, big-endian is used, otherwise `little-endian` is used.
	*/
	bigEndian: boolean
	
	/**
	Write one byte.
	*/
	writeByte(c: number): void
	
	/**
	Write `len` bytes from `s` starting by position specified by `pos`.
	
	Returns the actual length of written data that can differ from `len`.
	
	See `writeFullBytes` that tries to write the exact amount of specified bytes.
	*/
	writeBytes(s: Bytes, pos: number, len: number): number
	
	/**
	Flush any buffered data.
	*/
	flush(): void
	
	/**
	Close the output.
	
	Behaviour while writing after calling this method is unspecified.
	*/
	close(): void
	protected set_bigEndian(b: boolean): boolean
	
	/**
	Write all bytes stored in `s`.
	*/
	write(s: Bytes): void
	
	/**
	Write `len` bytes from `s` starting by position specified by `pos`.
	
	Unlike `writeBytes`, this method tries to write the exact `len` amount of bytes.
	*/
	writeFullBytes(s: Bytes, pos: number, len: number): void
	
	/**
	Write `x` as 32-bit floating point number.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeFloat(x: number): void
	
	/**
	Write `x` as 64-bit double-precision floating point number.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeDouble(x: number): void
	
	/**
	Write `x` as 8-bit signed integer.
	*/
	writeInt8(x: number): void
	
	/**
	Write `x` as 16-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeInt16(x: number): void
	
	/**
	Write `x` as 16-bit unsigned integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeUInt16(x: number): void
	
	/**
	Write `x` as 24-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeInt24(x: number): void
	
	/**
	Write `x` as 24-bit unsigned integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeUInt24(x: number): void
	
	/**
	Write `x` as 32-bit signed integer.
	
	Endianness is specified by the `bigEndian` property.
	*/
	writeInt32(x: number): void
	
	/**
	Inform that we are about to write at least `nbytes` bytes.
	
	The underlying implementation can allocate proper working space depending
	on this information, or simply ignore it. This is not a mandatory call
	but a tip and is only used in some specific cases.
	*/
	prepare(nbytes: number): void
	
	/**
	Read all available data from `i` and write it.
	
	The `bufsize` optional argument specifies the size of chunks by
	which data is read and written. Its default value is 4096.
	*/
	writeInput(i: Input, bufsize?: null | number): void
	
	/**
	Write `s` string.
	*/
	writeString(s: string, encoding?: null | Encoding): void
}

//# sourceMappingURL=Output.d.ts.map