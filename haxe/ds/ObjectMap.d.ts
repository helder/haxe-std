import {IMap} from "../Constraints"
import {EsMap} from "../../genes/util/EsMap"
import {KeyValueIterator} from "../../StdTypes"

export declare class ObjectMap<K, V> extends EsMap<K, V> implements IMap<K, V> {
	constructor()
	copy(): ObjectMap<K, V>
	keyValueIterator(): KeyValueIterator<K, V>
}

//# sourceMappingURL=ObjectMap.d.ts.map