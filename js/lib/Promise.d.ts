
export type ThenableStruct<T> = {then: <TOut>(onFulfilled: null | ((arg0: T) => any), onRejected?: ((arg0: any) => any)) => ThenableStruct<TOut>}

export type PromiseSettleOutcome = {reason?: null | any, status: string, value?: null | any}

//# sourceMappingURL=Promise.d.ts.map