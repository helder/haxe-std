import {Iterator as Iterator__1} from "../../js/lib/Iterator"
import {Iterator, Iterator as Iterator__2} from "../../StdTypes"

export declare class EsMap<K, V> {
	constructor()
	set(key: K, value: V): void
	get(key: K): null | V
	remove(key: K): boolean
	exists(key: K): boolean
	keys(): Iterator<K>
	iterator(): Iterator<V>
	toString(): string
	clear(): void
}

//# sourceMappingURL=EsMap.d.ts.map