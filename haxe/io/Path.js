import {Register} from "../../genes/Register.js"
import {StringTools} from "../../StringTools.js"
import {Std} from "../../Std.js"
import {HxOverrides} from "../../HxOverrides.js"
import {EReg} from "../../EReg.js"

/**
This class provides a convenient way of working with paths. It supports the
common path formats:

- `directory1/directory2/filename.extension`
- `directory1\directory2\filename.extension`
*/
export const Path = Register.global("$hxClasses")["haxe.io.Path"] = 
class Path extends Register.inherits() {
	new(path) {
		switch (path) {
			case ".":case "..":
				this.dir = path;
				this.file = "";
				return;
				break
			
		};
		let c1 = path.lastIndexOf("/");
		let c2 = path.lastIndexOf("\\");
		if (c1 < c2) {
			this.dir = HxOverrides.substr(path, 0, c2);
			path = HxOverrides.substr(path, c2 + 1, null);
			this.backslash = true;
		} else if (c2 < c1) {
			this.dir = HxOverrides.substr(path, 0, c1);
			path = HxOverrides.substr(path, c1 + 1, null);
		} else {
			this.dir = null;
		};
		let cp = path.lastIndexOf(".");
		if (cp != -1) {
			this.ext = HxOverrides.substr(path, cp + 1, null);
			this.file = HxOverrides.substr(path, 0, cp);
		} else {
			this.ext = null;
			this.file = path;
		};
	}
	
	/**
	Returns a String representation of `this` path.
	
	If `this.backslash` is `true`, backslash is used as directory separator,
	otherwise slash is used. This only affects the separator between
	`this.dir` and `this.file`.
	
	If `this.directory` or `this.extension` is `null`, their representation
	is the empty String `""`.
	*/
	toString() {
		return ((this.dir == null) ? "" : this.dir + ((this.backslash) ? "\\" : "/")) + this.file + ((this.ext == null) ? "" : "." + this.ext);
	}
	
	/**
	Returns the String representation of `path` without the file extension.
	
	If `path` is `null`, the result is unspecified.
	*/
	static withoutExtension(path) {
		let s = new Path(path);
		s.ext = null;
		return s.toString();
	}
	
	/**
	Returns the String representation of `path` without the directory.
	
	If `path` is `null`, the result is unspecified.
	*/
	static withoutDirectory(path) {
		let s = new Path(path);
		s.dir = null;
		return s.toString();
	}
	
	/**
	Returns the directory of `path`.
	
	If the directory is `null`, the empty String `""` is returned.
	
	If `path` is `null`, the result is unspecified.
	*/
	static directory(path) {
		let s = new Path(path);
		if (s.dir == null) {
			return "";
		};
		return s.dir;
	}
	
	/**
	Returns the extension of `path`.
	
	If `path` has no extension, the empty String `""` is returned.
	
	If `path` is `null`, the result is unspecified.
	*/
	static extension(path) {
		let s = new Path(path);
		if (s.ext == null) {
			return "";
		};
		return s.ext;
	}
	
	/**
	Returns a String representation of `path` where the extension is `ext`.
	
	If `path` has no extension, `ext` is added as extension.
	
	If `path` or `ext` are `null`, the result is unspecified.
	*/
	static withExtension(path, ext) {
		let s = new Path(path);
		s.ext = ext;
		return s.toString();
	}
	
	/**
	Joins all paths in `paths` together.
	
	If `paths` is empty, the empty String `""` is returned. Otherwise the
	paths are joined with a slash between them.
	
	If `paths` is `null`, the result is unspecified.
	*/
	static join(paths) {
		let _g = [];
		let _g1 = 0;
		let _g2 = paths;
		while (_g1 < _g2.length) {
			let v = _g2[_g1];
			++_g1;
			if (v != null && v != "") {
				_g.push(v);
			};
		};
		let paths1 = _g;
		if (paths1.length == 0) {
			return "";
		};
		let path = paths1[0];
		let _g3 = 1;
		let _g4 = paths1.length;
		while (_g3 < _g4) {
			let i = _g3++;
			path = Path.addTrailingSlash(path);
			path += paths1[i];
		};
		return Path.normalize(path);
	}
	
	/**
	Normalize a given `path` (e.g. turn `'/usr/local/../lib'` into `'/usr/lib'`).
	
	Also replaces backslashes `\` with slashes `/` and afterwards turns
	multiple slashes into a single one.
	
	If `path` is `null`, the result is unspecified.
	*/
	static normalize(path) {
		let slash = "/";
		path = path.split("\\").join(slash);
		if (path == slash) {
			return slash;
		};
		let target = [];
		let _g = 0;
		let _g1 = path.split(slash);
		while (_g < _g1.length) {
			let token = _g1[_g];
			++_g;
			if (token == ".." && target.length > 0 && target[target.length - 1] != "..") {
				target.pop();
			} else if (token == "") {
				if (target.length > 0 || HxOverrides.cca(path, 0) == 47) {
					target.push(token);
				};
			} else if (token != ".") {
				target.push(token);
			};
		};
		let tmp = target.join(slash);
		let acc_b = "";
		let colon = false;
		let slashes = false;
		let _g2_offset = 0;
		let _g2_s = tmp;
		while (_g2_offset < _g2_s.length) {
			let s = _g2_s;
			let index = _g2_offset++;
			let c = s.charCodeAt(index);
			if (c >= 55296 && c <= 56319) {
				c = c - 55232 << 10 | s.charCodeAt(index + 1) & 1023;
			};
			let c1 = c;
			if (c1 >= 65536) {
				++_g2_offset;
			};
			let c2 = c1;
			switch (c2) {
				case 47:
					if (!colon) {
						slashes = true;
					} else {
						let i = c2;
						colon = false;
						if (slashes) {
							acc_b += "/";
							slashes = false;
						};
						acc_b += String.fromCodePoint(i);
					};
					break
				case 58:
					acc_b += ":";
					colon = true;
					break
				default:
				let i = c2;
				colon = false;
				if (slashes) {
					acc_b += "/";
					slashes = false;
				};
				acc_b += String.fromCodePoint(i);
				
			};
		};
		return acc_b;
	}
	
	/**
	Adds a trailing slash to `path`, if it does not have one already.
	
	If the last slash in `path` is a backslash, a backslash is appended to
	`path`.
	
	If the last slash in `path` is a slash, or if no slash is found, a slash
	is appended to `path`. In particular, this applies to the empty String
	`""`.
	
	If `path` is `null`, the result is unspecified.
	*/
	static addTrailingSlash(path) {
		if (path.length == 0) {
			return "/";
		};
		let c1 = path.lastIndexOf("/");
		let c2 = path.lastIndexOf("\\");
		if (c1 < c2) {
			if (c2 != path.length - 1) {
				return path + "\\";
			} else {
				return path;
			};
		} else if (c1 != path.length - 1) {
			return path + "/";
		} else {
			return path;
		};
	}
	
	/**
	Removes trailing slashes from `path`.
	
	If `path` does not end with a `/` or `\`, `path` is returned unchanged.
	
	Otherwise the substring of `path` excluding the trailing slashes or
	backslashes is returned.
	
	If `path` is `null`, the result is unspecified.
	*/
	static removeTrailingSlashes(path) {
		_hx_loop1: while (true) {
			let _g = HxOverrides.cca(path, path.length - 1);
			if (_g == null) {
				break;
			} else {
				switch (_g) {
					case 47:case 92:
						path = HxOverrides.substr(path, 0, -1);
						break
					default:
					break _hx_loop1;
					
				};
			};
		};
		return path;
	}
	
	/**
	Returns `true` if the path is an absolute path, and `false` otherwise.
	*/
	static isAbsolute(path) {
		if (StringTools.startsWith(path, "/")) {
			return true;
		};
		if (path.charAt(1) == ":") {
			return true;
		};
		if (StringTools.startsWith(path, "\\\\")) {
			return true;
		};
		return false;
	}
	static unescape(path) {
		let regex = new EReg("-x([0-9][0-9])", "g");
		return regex.map(path, function (regex) {
			let code = Std.parseInt(regex.matched(1));
			return String.fromCodePoint(code);
		});
	}
	static escape(path, allowSlashes = false) {
		let regex = (allowSlashes) ? new EReg("[^A-Za-z0-9_/\\\\\\.]", "g") : new EReg("[^A-Za-z0-9_\\.]", "g");
		return regex.map(path, function (v) {
			return "-x" + HxOverrides.cca(v.matched(0), 0);
		});
	}
	static get __name__() {
		return "haxe.io.Path"
	}
	get __class__() {
		return Path
	}
}


//# sourceMappingURL=Path.js.map