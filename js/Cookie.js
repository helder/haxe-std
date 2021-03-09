import {StringMap} from "../haxe/ds/StringMap.js"
import {Register} from "../genes/Register.js"
import {StringTools} from "../StringTools.js"

export const Cookie = Register.global("$hxClasses")["js.Cookie"] = 
class Cookie {
	
	/**
	Create or update a cookie.
	@param  expireDelay  In seconds. If null, the cookie expires at end of session.
	*/
	static set(name, value, expireDelay = null, path = null, domain = null) {
		let s = name + "=" + encodeURIComponent(value);
		if (expireDelay != null) {
			let d = new Date(new Date().getTime() + expireDelay * 1000);
			s += ";expires=" + d.toGMTString();
		};
		if (path != null) {
			s += ";path=" + path;
		};
		if (domain != null) {
			s += ";domain=" + domain;
		};
		window.document.cookie = s;
	}
	
	/**
	Returns all cookies.
	*/
	static all() {
		let h = new StringMap();
		let a = window.document.cookie.split(";");
		let _g = 0;
		while (_g < a.length) {
			let e = a[_g];
			++_g;
			e = StringTools.ltrim(e);
			let t = e.split("=");
			if (t.length < 2) {
				continue;
			};
			let value = decodeURIComponent(t[1].split("+").join(" "));
			h.inst.set(t[0], value);
		};
		return h;
	}
	
	/**
	Returns value of a cookie.
	*/
	static get(name) {
		return Cookie.all().inst.get(name);
	}
	
	/**
	Returns true if a cookie `name` exists.
	*/
	static exists(name) {
		return Cookie.all().inst.has(name);
	}
	
	/**
	Remove a cookie.
	*/
	static remove(name, path = null, domain = null) {
		Cookie.set(name, "", -10, path, domain);
	}
	static get __name__() {
		return "js.Cookie"
	}
	get __class__() {
		return Cookie
	}
}


//# sourceMappingURL=Cookie.js.map