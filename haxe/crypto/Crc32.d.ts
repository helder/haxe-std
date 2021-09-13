import {Bytes} from "../io/Bytes"

/**
Calculates the Crc32 of the given Bytes.
*/
export declare class Crc32 {
	constructor()
	protected crc: number
	byte(b: number): void
	update(b: Bytes, pos: number, len: number): void
	get(): number
	
	/**
	Calculates the CRC32 of the given data bytes
	*/
	static make(data: Bytes): number
}

//# sourceMappingURL=Crc32.d.ts.map