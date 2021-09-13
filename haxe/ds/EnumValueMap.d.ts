import {BalancedTree} from "./BalancedTree"
import {IMap} from "../Constraints"

/**
EnumValueMap allows mapping of enum value keys to arbitrary values.

Keys are compared by value and recursively over their parameters. If any
parameter is not an enum value, `Reflect.compare` is used to compare them.
*/
export declare class EnumValueMap<K extends any, V> extends BalancedTree<K, V> implements IMap<K, V> {
	constructor()
	protected compare(k1: any, k2: any): number
	protected compareArgs(a1: any[], a2: any[]): number
	protected compareArg(v1: any, v2: any): number
	copy(): EnumValueMap<K, V>
}

//# sourceMappingURL=EnumValueMap.d.ts.map