import {Entry} from "./Entry"
import {Output} from "../io/Output"
import {Bytes} from "../io/Bytes"
import {List} from "../ds/List"

export declare class Writer {
	constructor(o: Output)
	writeEntryHeader(f: Entry): void
	write(files: List<Entry>): void
	writeCDR(): void
}

//# sourceMappingURL=Writer.d.ts.map