import {HaxeError} from "./Boot.js"
import {CallStack} from "../haxe/CallStack.js"
import {Register} from "../genes/Register.js"
import {Std} from "../Std.js"

export const Browser = Register.global("$hxClasses")["js.Browser"] = 
class Browser {
	
	/**
	* Safely gets the browser's local storage, or returns null if localStorage is unsupported or
	* disabled.
	*/
	static getLocalStorage() {
		try {
			var s = window.localStorage;
			s.getItem("");
			if (s.length == 0) {
				var key = "_hx_" + Math.random();
				s.setItem(key, key);
				s.removeItem(key);
			};
			return s;
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
			return null;
		};
	}
	
	/**
	* Safely gets the browser's session storage, or returns null if sessionStorage is unsupported
	* or disabled.
	*/
	static getSessionStorage() {
		try {
			var s = window.sessionStorage;
			s.getItem("");
			if (s.length == 0) {
				var key = "_hx_" + Math.random();
				s.setItem(key, key);
				s.removeItem(key);
			};
			return s;
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
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
		throw new HaxeError("Unable to create XMLHttpRequest object.");
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