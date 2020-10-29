import {IMap} from "../Constraints"
import {EsMap} from "../../genes/util/EsMap"
import {KeyValueIterator} from "../../StdTypes"

export declare class IntMap<T> extends EsMap<number, T> implements IMap<number, T> {
	constructor()
	copy(): IntMap<T>
	keyValueIterator(): KeyValueIterator<number, T>
}

//# sourceMappingURL=IntMap.d.ts.map