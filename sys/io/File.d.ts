import {FileOutput} from "./FileOutput"
import {FileInput} from "./FileInput"
import {Bytes} from "../../haxe/io/Bytes"
import {Buffer} from "buffer"

export declare class File {
	static append(path: string, binary?: boolean): FileOutput
	static write(path: string, binary?: boolean): FileOutput
	static read(path: string, binary?: boolean): FileInput
	static getContent(path: string): string
	static saveContent(path: string, content: string): void
	static getBytes(path: string): Bytes
	static saveBytes(path: string, bytes: Bytes): void
	protected static copyBufLen: number
	protected static copyBuf: Buffer
	static copy(srcPath: string, dstPath: string): void
}

//# sourceMappingURL=File.d.ts.map