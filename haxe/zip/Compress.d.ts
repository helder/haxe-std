import {FlushMode} from "./FlushMode"
import {Bytes} from "../io/Bytes"

export declare class Compress {
	constructor(level: number)
	execute(src: Bytes, srcPos: number, dst: Bytes, dstPos: number): {done: boolean, read: number, write: number}
	setFlushMode(f: FlushMode): void
	close(): void
	static run(s: Bytes, level: number): Bytes
}

//# sourceMappingURL=Compress.d.ts.map