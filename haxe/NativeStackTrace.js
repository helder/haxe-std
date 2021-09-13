import {StackItem} from "./CallStack.js"
import {Register} from "../genes/Register.js"
import {StringTools} from "../StringTools.js"
import {Std} from "../Std.js"

const $global = Register.$global

/**
Do not use manually.
*/
export const NativeStackTrace = Register.global("$hxClasses")["haxe.NativeStackTrace"] = 
class NativeStackTrace {
	static saveStack(e) {
		NativeStackTrace.lastError = e;
	}
	static callStack() {
		var e = new Error("");
		var stack = NativeStackTrace.tryHaxeStack(e);
		if (typeof(stack) == "undefined") {
			try {
				throw e;
			}catch (_g) {
			};
			stack = e.stack;
		};
		return NativeStackTrace.normalize(stack, 2);
	}
	static exceptionStack() {
		return NativeStackTrace.normalize(NativeStackTrace.tryHaxeStack(NativeStackTrace.lastError));
	}
	static toHaxe(s, skip) {
		if (skip == null) {
			skip = 0;
		};
		if (s == null) {
			return [];
		} else if (typeof(s) == "string") {
			var stack = s.split("\n");
			if (stack[0] == "Error") {
				stack.shift();
			};
			var m = [];
			var _g = 0;
			var _g1 = stack.length;
			while (_g < _g1) {
				var i = _g++;
				if (skip > i) {
					continue;
				};
				var line = stack[i];
				var matched = line.match(/^    at ([A-Za-z0-9_. ]+) \(([^)]+):([0-9]+):([0-9]+)\)$/);
				if (matched != null) {
					var path = matched[1].split(".");
					if (path[0] == "$hxClasses") {
						path.shift();
					};
					var meth = path.pop();
					var file = matched[2];
					var line1 = Std.parseInt(matched[3]);
					var column = Std.parseInt(matched[4]);
					m.push(StackItem.FilePos((meth == "Anonymous function") ? StackItem.LocalFunction() : (meth == "Global code") ? null : StackItem.Method(path.join("."), meth), file, line1, column));
				} else {
					m.push(StackItem.Module(StringTools.trim(line)));
				};
			};
			return m;
		} else if (skip > 0 && Array.isArray(s)) {
			return s.slice(skip);
		} else {
			return s;
		};
	}
	static tryHaxeStack(e) {
		if (e == null) {
			return [];
		};
		var oldValue = Error.prepareStackTrace;
		Error.prepareStackTrace = NativeStackTrace.prepareHxStackTrace;
		var stack = e.stack;
		Error.prepareStackTrace = oldValue;
		return stack;
	}
	static prepareHxStackTrace(e, callsites) {
		var stack = [];
		var _g = 0;
		while (_g < callsites.length) {
			var site = callsites[_g];
			++_g;
			if (NativeStackTrace.wrapCallSite != null) {
				site = NativeStackTrace.wrapCallSite(site);
			};
			var method = null;
			var fullName = site.getFunctionName();
			if (fullName != null) {
				var idx = fullName.lastIndexOf(".");
				if (idx >= 0) {
					var className = fullName.substring(0, idx);
					var methodName = fullName.substring(idx + 1);
					method = StackItem.Method(className, methodName);
				} else {
					method = StackItem.Method(null, fullName);
				};
			};
			var fileName = site.getFileName();
			var fileAddr = (fileName == null) ? -1 : fileName.indexOf("file:");
			if (NativeStackTrace.wrapCallSite != null && fileAddr > 0) {
				fileName = fileName.substring(fileAddr + 6);
			};
			stack.push(StackItem.FilePos(method, fileName, site.getLineNumber(), site.getColumnNumber()));
		};
		return stack;
	}
	static normalize(stack, skipItems) {
		if (skipItems == null) {
			skipItems = 0;
		};
		if (Array.isArray(stack) && skipItems > 0) {
			return stack.slice(skipItems);
		} else if (typeof(stack) == "string") {
			switch (stack.substring(0, 6)) {
				case "Error\n":case "Error:":
					++skipItems;
					break
				default:
				
			};
			return NativeStackTrace.skipLines(stack, skipItems);
		} else {
			return stack;
		};
	}
	static skipLines(stack, skip, pos) {
		if (pos == null) {
			pos = 0;
		};
		if (skip > 0) {
			pos = stack.indexOf("\n", pos);
			if (pos < 0) {
				return "";
			} else {
				return NativeStackTrace.skipLines(stack, --skip, pos + 1);
			};
		} else {
			return stack.substring(pos);
		};
	}
	static get __name__() {
		return "haxe.NativeStackTrace"
	}
	get __class__() {
		return NativeStackTrace
	}
}


//# sourceMappingURL=NativeStackTrace.js.map