import {Encoding} from "./Encoding"
import {__Int64} from "../Int64"

export declare class Bytes {
	length: number
	
	/**
	Returns the byte at index `pos`.
	*/
	get(pos: number): number
	
	/**
	Stores the given byte `v` at the given position `pos`.
	*/
	set(pos: number, v: number): void
	
	/**
	Copies `len` bytes from `src` into this instance.
	@param pos Zero-based location in `this` instance at which to start writing
	bytes.
	@param src Source `Bytes` instance from which to copy bytes.
	@param srcpos Zero-based location at `src` from which bytes will be copied.
	@param len Number of bytes to be copied.
	*/
	blit(pos: number, src: Bytes, srcpos: number, len: number): void
	
	/**
	Sets `len` consecutive bytes starting from index `pos` of `this` instance
	to `value`.
	*/
	fill(pos: number, len: number, value: number): void
	
	/**
	Returns a new `Bytes` instance that contains a copy of `len` bytes of
	`this` instance, starting at index `pos`.
	*/
	sub(pos: number, len: number): Bytes
	
	/**
	Returns `0` if the bytes of `this` instance and the bytes of `other` are
	identical.
	
	Returns a negative value if the `length` of `this` instance is less than
	the `length` of `other`, or a positive value if the `length` of `this`
	instance is greater than the `length` of `other`.
	
	In case of equal `length`s, returns a negative value if the first different
	value in `other` is greater than the corresponding value in `this`
	instance; otherwise returns a positive value.
	*/
	compare(other: Bytes): number
	
	/**
	Returns the IEEE double-precision value at the given position `pos` (in
	little-endian encoding). Result is unspecified if `pos` is outside the
	bounds.
	*/
	getDouble(pos: number): number
	
	/**
	Returns the IEEE single-precision value at the given position `pos` (in
	little-endian encoding). Result is unspecified if `pos` is outside the
	bounds.
	*/
	getFloat(pos: number): number
	
	/**
	Stores the given IEEE double-precision value `v` at the given position
	`pos` in little-endian encoding. Result is unspecified if writing outside
	of bounds.
	*/
	setDouble(pos: number, v: number): void
	
	/**
	Stores the given IEEE single-precision value `v` at the given position
	`pos` in little-endian encoding. Result is unspecified if writing outside
	of bounds.
	*/
	setFloat(pos: number, v: number): void
	
	/**
	Returns the 16-bit unsigned integer at the given position `pos` (in
	little-endian encoding).
	*/
	getUInt16(pos: number): number
	
	/**
	Stores the given 16-bit unsigned integer `v` at the given position `pos`
	(in little-endian encoding).
	*/
	setUInt16(pos: number, v: number): void
	
	/**
	Returns the 32-bit integer at the given position `pos` (in little-endian
	encoding).
	*/
	getInt32(pos: number): number
	
	/**
	Stores the given 32-bit integer `v` at the given position `pos` (in
	little-endian encoding).
	*/
	setInt32(pos: number, v: number): void
	
	/**
	Returns the 64-bit integer at the given position `pos` (in little-endian
	encoding).
	*/
	getInt64(pos: number): __Int64
	
	/**
	Stores the given 64-bit integer `v` at the given position `pos` (in
	little-endian encoding).
	*/
	setInt64(pos: number, v: __Int64): void
	
	/**
	Returns the `len`-bytes long string stored at the given position `pos`,
	interpreted with the given `encoding` (UTF-8 by default).
	*/
	getString(pos: number, len: number, encoding?: null | Encoding): string
	readString(pos: number, len: number): string
	
	/**
	Returns a `String` representation of the bytes interpreted as UTF-8.
	*/
	toString(): string
	
	/**
	Returns a hexadecimal `String` representation of the bytes of `this`
	instance.
	*/
	toHex(): string
	
	/**
	Returns the bytes of `this` instance as `BytesData`.
	*/
	getData(): ArrayBuffer
	
	/**
	Returns a new `Bytes` instance with the given `length`. The values of the
	bytes are not initialized and may not be zero.
	*/
	static alloc(length: number): Bytes
	
	/**
	Returns the `Bytes` representation of the given `String`, using the
	specified encoding (UTF-8 by default).
	*/
	static ofString(s: string, encoding?: null | Encoding): Bytes
	
	/**
	Returns the `Bytes` representation of the given `BytesData`.
	*/
	static ofData(b: ArrayBuffer): Bytes
	
	/**
	Converts the given hexadecimal `String` to `Bytes`. `s` must be a string of
	even length consisting only of hexadecimal digits. For example:
	`"0FDA14058916052309"`.
	*/
	static ofHex(s: string): Bytes
	
	/**
	Reads the `pos`-th byte of the given `b` bytes, in the most efficient way
	possible. Behavior when reading outside of the available data is
	unspecified.
	*/
	static fastGet(b: ArrayBuffer, pos: number): number
}

//# sourceMappingURL=Bytes.d.ts.map