import {FlushMode} from "./FlushMode"
import {Bytes} from "../io/Bytes"

export declare class Uncompress {
	constructor(windowBits?: null | number)
	execute(src: Bytes, srcPos: number, dst: Bytes, dstPos: number): {done: boolean, read: number, write: number}
	setFlushMode(f: FlushMode): void
	close(): void
	static run(src: Bytes, bufsize?: null | number): Bytes
}

//# sourceMappingURL=Uncompress.d.ts.map