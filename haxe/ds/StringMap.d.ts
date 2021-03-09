import {IMap} from "../Constraints"
import {EsMap} from "../../genes/util/EsMap"
import {KeyValueIterator} from "../../StdTypes"

export declare class StringMap<T> extends EsMap<string, T> implements IMap<string, T> {
	constructor()
	copy(): StringMap<T>
	keyValueIterator(): KeyValueIterator<string, T>
}

//# sourceMappingURL=StringMap.d.ts.map