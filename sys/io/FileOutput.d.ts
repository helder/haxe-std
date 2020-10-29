import {FileSeek} from "./FileSeek"
import {Output} from "../../haxe/io/Output"
import {Bytes} from "../../haxe/io/Bytes"

/**
Use `sys.io.File.write` to create a `FileOutput`.
*/
export declare class FileOutput extends Output {
	writeByte(b: number): void
	writeBytes(s: Bytes, pos: number, len: number): number
	close(): void
	seek(p: number, pos: FileSeek): void
	tell(): number
}

//# sourceMappingURL=FileOutput.d.ts.map