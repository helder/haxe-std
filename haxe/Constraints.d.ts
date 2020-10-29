import {Iterator, KeyValueIterator} from "../StdTypes"

export declare interface IMap<K, V> {
	get(k: K): null | V
	set(k: K, v: V): void
	exists(k: K): boolean
	remove(k: K): boolean
	keys(): Iterator<K>
	iterator(): Iterator<V>
	keyValueIterator(): KeyValueIterator<K, V>
	copy(): IMap<K, V>
	toString(): string
	clear(): void
}

//# sourceMappingURL=Constraints.d.ts.map