import {NativeStackTrace} from "../haxe/NativeStackTrace"
import {Exception} from "../haxe/Exception"
import {Register} from "../genes/Register"
import {Std} from "../Std"

export const Browser = Register.global("$hxClasses")["js.Browser"] = 
class Browser {
	static get self() {
		return this.get_self()
	}
	static get_self() {
		return $global;
	}
	
	/**
	* Safely gets the browser's local storage, or returns null if localStorage is unsupported or
	* disabled.
	*/
	static getLocalStorage() {
		try {
			let s = window.localStorage;
			s.getItem("");
			if (s.length == 0) {
				let key = "_hx_" + Math.random();
				s.setItem(key, key);
				s.removeItem(key);
			};
			return s;
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			return null;
		};
	}
	
	/**
	* Safely gets the browser's session storage, or returns null if sessionStorage is unsupported
	* or disabled.
	*/
	static getSessionStorage() {
		try {
			let s = window.sessionStorage;
			s.getItem("");
			if (s.length == 0) {
				let key = "_hx_" + Math.random();
				s.setItem(key, key);
				s.removeItem(key);
			};
			return s;
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			return null;
		};
	}
	
	/**
	* Creates an XMLHttpRequest, with a fallback to ActiveXObject for ancient versions of Internet
	* Explorer.
	*/
	static createXMLHttpRequest() {
		if (typeof XMLHttpRequest != "undefined") {
			return new XMLHttpRequest();
		};
		if (typeof ActiveXObject != "undefined") {
			return new "ActiveXObject"("Microsoft.XMLHTTP");
		};
		throw Exception.thrown("Unable to create XMLHttpRequest object.");
	}
	
	/**
	Display an alert message box containing the given message. See also `Window.alert()`.
	*/
	static alert(v) {
		window.alert(Std.string(v));
	}
	static get __name__() {
		return "js.Browser"
	}
	get __class__() {
		return Browser
	}
}


//# sourceMappingURL=Browser.js.map