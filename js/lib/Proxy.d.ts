import {ObjectPropertyDescriptor} from "./Object"

export type ProxyHandler<T> = {apply?: null | ((target: T, thisArg: {}, argumentsList: any[]) => any), construct?: null | ((target: any, argumentsList: any[], newTarget: any) => void), defineProperty?: null | ((target: T, property: string | Symbol, descriptor: ObjectPropertyDescriptor) => boolean), deleteProperty?: null | ((target: T, property: string | number | Symbol) => boolean), get?: null | ((target: T, property: string | number | Symbol, receiver: null | {}) => any), getOwnPropertyDescriptor?: null | ((target: T, prop: string | Symbol) => null | ObjectPropertyDescriptor), getPrototypeOf?: null | ((target: T) => null | {}), has?: null | ((target: T, prop: string | number | Symbol) => boolean), isExtensible?: null | ((target: T) => boolean), ownKeys?: null | ((target: T) => string[]), preventExtensions?: null | ((target: T) => boolean), set?: null | ((target: T, property: string | number | Symbol, value: any, receiver: null | {}) => boolean), setPrototypeOf?: null | ((target: T, prototype: null | {}) => boolean)}

export type RevocableProxy<T> = {proxy: Proxy<T>, revoke: () => void}

//# sourceMappingURL=Proxy.d.ts.map