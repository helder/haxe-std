import {BalancedTree} from "./BalancedTree"
import {IMap} from "../Constraints"

/**
EnumValueMap allows mapping of enum value keys to arbitrary values.

Keys are compared by value and recursively over their parameters. If any
parameter is not an enum value, `Reflect.compare` is used to compare them.
*/
export declare class EnumValueMap<K, V> extends BalancedTree<K, V> implements IMap<K, V> {
	constructor()
	copy(): EnumValueMap<K, V>
}

//# sourceMappingURL=EnumValueMap.d.ts.map