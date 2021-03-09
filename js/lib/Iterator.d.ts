
export type Iterator<T> = {next: () => IteratorStep<T>}

export type AsyncIterator<T> = {next: () => Promise<IteratorStep<T>>}

export type IteratorStep<T> = {done: boolean, value?: null | T}

//# sourceMappingURL=Iterator.d.ts.map