
export declare namespace Either {
	export type Right<L, R> = {_hx_index: 1, v: R, __enum__: "haxe.ds.Either"}
	export const Right: <L, R>(v: R) => Either<L, R>
	export type Left<L, R> = {_hx_index: 0, v: L, __enum__: "haxe.ds.Either"}
	export const Left: <L, R>(v: L) => Either<L, R>
}

/**
Either represents values which are either of type `L` (Left) or type `R`
(Right).
*/
export declare type Either<L, R> = 
	| Either.Right<L, R>
	| Either.Left<L, R>

//# sourceMappingURL=Either.d.ts.map