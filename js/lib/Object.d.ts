
export type ObjectPrototype = {hasOwnProperty: Function, isPrototypeOf: Function, propertyIsEnumerable: Function, toLocaleString: Function, toString: Function, valueOf: Function}

export type ObjectPropertyDescriptor = {configurable?: null | boolean, enumerable?: null | boolean, get?: null | (() => any), set?: null | ((arg0: any) => void), value?: null | any, writable?: null | boolean}

export declare class ObjectEntry {
	static readonly key: string
	static readonly value: any
	protected static get_key($this: any[]): string
	protected static get_value($this: any[]): any
}

//# sourceMappingURL=Object.d.ts.map