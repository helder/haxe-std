
export type MetaObject = {fields?: null | {[key: string]: {[key: string]: null | any[]}}, obj?: null | {[key: string]: null | any[]}, statics?: null | {[key: string]: {[key: string]: null | any[]}}}

/**
An API to access classes and enums metadata at runtime.

@see <https://haxe.org/manual/cr-rtti.html>
*/
export declare class Meta {
	
	/**
	Returns the metadata that were declared for the given type (class or enum)
	*/
	static getType(t: any): {[key: string]: any[]}
	protected static isInterface(t: any): boolean
	protected static getMeta(t: any): MetaObject
	
	/**
	Returns the metadata that were declared for the given class static fields
	*/
	static getStatics(t: any): {[key: string]: {[key: string]: any[]}}
	
	/**
	Returns the metadata that were declared for the given class fields or enum constructors
	*/
	static getFields(t: any): {[key: string]: {[key: string]: any[]}}
}

//# sourceMappingURL=Meta.d.ts.map