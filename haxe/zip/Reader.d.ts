import {ExtraField, Entry} from "./Entry"
import {Input} from "../io/Input"
import {Bytes} from "../io/Bytes"
import {List} from "../ds/List"

export declare class Reader {
	constructor(i: Input)
	protected i: Input
	protected readZipDate(): Date
	protected readExtraFields(length: number): List<ExtraField>
	readEntryHeader(): Entry
	read(): List<Entry>
	static readZip(i: Input): List<Entry>
	static unzip(f: Entry): null | Bytes
}

//# sourceMappingURL=Reader.d.ts.map