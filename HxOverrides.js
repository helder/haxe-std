import {ArrayKeyValueIterator} from "./haxe/iterators/ArrayKeyValueIterator"
import {Exception} from "./haxe/Exception"
import {Register} from "./genes/Register"

export const HxOverrides = Register.global("$hxClasses")["HxOverrides"] = 
class HxOverrides {
	static dateStr(date) {
		let m = date.getMonth() + 1;
		let d = date.getDate();
		let h = date.getHours();
		let mi = date.getMinutes();
		let s = date.getSeconds();
		return date.getFullYear() + "-" + ((m < 10) ? "0" + m : "" + m) + "-" + ((d < 10) ? "0" + d : "" + d) + " " + ((h < 10) ? "0" + h : "" + h) + ":" + ((mi < 10) ? "0" + mi : "" + mi) + ":" + ((s < 10) ? "0" + s : "" + s);
	}
	static strDate(s) {
		switch (s.length) {
			case 8:
				let k = s.split(":");
				let d = new Date();
				d["setTime"](0);
				d["setUTCHours"](k[0]);
				d["setUTCMinutes"](k[1]);
				d["setUTCSeconds"](k[2]);
				return d;
				break
			case 10:
				let k1 = s.split("-");
				return new Date(k1[0], k1[1] - 1, k1[2], 0, 0, 0);
				break
			case 19:
				let k2 = s.split(" ");
				let y = k2[0].split("-");
				let t = k2[1].split(":");
				return new Date(y[0], y[1] - 1, y[2], t[0], t[1], t[2]);
				break
			default:
			throw Exception.thrown("Invalid date format : " + s);
			
		};
	}
	static cca(s, index) {
		let x = s.charCodeAt(index);
		if (x != x) {
			return undefined;
		};
		return x;
	}
	static substr(s, pos, len = null) {
		if (len == null) {
			len = s.length;
		} else if (len < 0) {
			if (pos == 0) {
				len = s.length + len;
			} else {
				return "";
			};
		};
		return s.substr(pos, len);
	}
	static indexOf(a, obj, i) {
		let len = a.length;
		if (i < 0) {
			i += len;
			if (i < 0) {
				i = 0;
			};
		};
		while (i < len) {
			if (((a[i]) === (obj))) {
				return i;
			};
			++i;
		};
		return -1;
	}
	static lastIndexOf(a, obj, i) {
		let len = a.length;
		if (i >= len) {
			i = len - 1;
		} else if (i < 0) {
			i += len;
		};
		while (i >= 0) {
			if (((a[i]) === (obj))) {
				return i;
			};
			--i;
		};
		return -1;
	}
	static remove(a, obj) {
		let i = a.indexOf(obj);
		if (i == -1) {
			return false;
		};
		a.splice(i, 1);
		return true;
	}
	static iter(a) {
		return {"cur": 0, "arr": a, "hasNext": function () {
			return this.cur < this.arr.length;
		}, "next": function () {
			return this.arr[this.cur++];
		}};
	}
	static keyValueIter(a) {
		return new ArrayKeyValueIterator(a);
	}
	static now() {
		return Date.now();
	}
	static get __name__() {
		return "HxOverrides"
	}
	get __class__() {
		return HxOverrides
	}
}


;((typeof(performance) != "undefined") ? typeof(performance.now) == "function" : false) ? HxOverrides.now = performance.now.bind(performance) : null

//# sourceMappingURL=HxOverrides.js.map