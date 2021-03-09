import {FileSeek} from "./FileSeek"
import {Input} from "../../haxe/io/Input"
import {Bytes} from "../../haxe/io/Bytes"

/**
Use `sys.io.File.read` to create a `FileInput`.
*/
export declare class FileInput extends Input {
	readByte(): number
	readBytes(s: Bytes, pos: number, len: number): number
	close(): void
	seek(p: number, pos: FileSeek): void
	tell(): number
	eof(): boolean
}

//# sourceMappingURL=FileInput.d.ts.map