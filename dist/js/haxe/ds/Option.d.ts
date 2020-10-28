
export declare namespace Option {
	export type Some<T> = {_hx_index: 0, v: T, __enum__: "haxe.ds.Option"}
	export const Some: <T>(v: T) => Option<T>
	export type None<T> = {_hx_index: 1, __enum__: "haxe.ds.Option"}
	export const None: None<any>
}

/**
An Option is a wrapper type which can either have a value (Some) or not a
value (None).

@see https://haxe.org/manual/std-Option.html
*/
export declare type Option<T> = 
	| Option.Some<T>
	| Option.None<T>

//# sourceMappingURL=Option.d.ts.map