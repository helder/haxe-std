
export declare namespace Either {
	export type Right<R, L> = {_hx_index: 1, v: R, __enum__: "haxe.ds.Either"}
	export const Right: <R, L>(v: R) => Either<L, R>
	export type Left<R, L> = {_hx_index: 0, v: L, __enum__: "haxe.ds.Either"}
	export const Left: <R, L>(v: L) => Either<L, R>
}

/**
Either represents values which are either of type `L` (Left) or type `R`
(Right).
*/
export declare type Either<L, R> = 
	| Either.Right<R, L>
	| Either.Left<R, L>

//# sourceMappingURL=Either.d.ts.map