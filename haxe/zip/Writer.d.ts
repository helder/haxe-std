import {Entry} from "./Entry"
import {Output} from "../io/Output"
import {Bytes} from "../io/Bytes"
import {List} from "../ds/List"

export declare class Writer {
	constructor(o: Output)
	protected o: Output
	protected files: List<{clen: number, compressed: boolean, crc: number, date: Date, fields: Bytes, name: string, size: number}>
	protected writeZipDate(date: Date): void
	writeEntryHeader(f: Entry): void
	write(files: List<Entry>): void
	writeCDR(): void
	
	/**
	The next constant is required for computing the Central
	Directory Record(CDR) size. CDR consists of some fields
	of constant size and a filename. Constant represents
	total length of all fields with constant size for each
	file in archive
	*/
	protected static CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE: number
	
	/**
	The following constant is the total size of all fields
	of Local File Header. It's required for calculating
	offset of start of central directory record
	*/
	protected static LOCAL_FILE_HEADER_FIELDS_SIZE: number
}

//# sourceMappingURL=Writer.d.ts.map