
export type WritableNewOptions = {autoDestroy?: null | boolean, decodeStrings?: null | boolean, defaultEncoding?: null | string, destroy?: null | ((error: null | Error, callback: ((arg0: null | Error) => void)) => void), emitClose?: null | boolean, final_?: null | ((error: null | Error) => void), highWaterMark?: null | number, objectMode?: null | boolean, write?: null | ((chunk: any, encoding: string, callback: ((arg0: null | Error) => void)) => void), writev?: null | ((chunks: Chunk[], callback: ((arg0: null | Error) => void)) => void)}

export declare class WritableNewOptionsAdapter {
	static from(options: WritableNewOptions): WritableNewOptions
}

export type Chunk = {chunk: any, encoding: string}

//# sourceMappingURL=Writable.d.ts.map