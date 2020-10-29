import {StringMap} from "../haxe/ds/StringMap"

export declare class Cookie {
	
	/**
	Create or update a cookie.
	@param  expireDelay  In seconds. If null, the cookie expires at end of session.
	*/
	static set(name: string, value: string, expireDelay?: null | number, path?: null | string, domain?: null | string): void
	
	/**
	Returns all cookies.
	*/
	static all(): StringMap<string>
	
	/**
	Returns value of a cookie.
	*/
	static get(name: string): null | string
	
	/**
	Returns true if a cookie `name` exists.
	*/
	static exists(name: string): boolean
	
	/**
	Remove a cookie.
	*/
	static remove(name: string, path?: null | string, domain?: null | string): void
}

//# sourceMappingURL=Cookie.d.ts.map