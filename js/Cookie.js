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
		var s = name + "=" + encodeURIComponent(value);
		if (expireDelay != null) {
			var d = new Date(new Date().getTime() + expireDelay * 1000);
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
		var h = new StringMap();
		var a = window.document.cookie.split(";");
		var _g = 0;
		while (_g < a.length) {
			var e = a[_g];
			++_g;
			e = StringTools.ltrim(e);
			var t = e.split("=");
			if (t.length < 2) {
				continue;
			};
			var value = decodeURIComponent(t[1].split("+").join(" "));
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