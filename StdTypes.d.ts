
export type Iterator<T> = {hasNext: () => boolean, next: () => T}

export type Iterable<T> = {iterator: () => Iterator<T>}

export type KeyValueIterator<K, V> = Iterator<{key: K, value: V}>

export type KeyValueIterable<K, V> = {keyValueIterator: () => KeyValueIterator<K, V>}

//# sourceMappingURL=StdTypes.d.ts.map