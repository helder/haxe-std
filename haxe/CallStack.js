import {HaxeError} from "../js/Boot"
import {Register} from "../genes/Register"
import {StringTools} from "../StringTools"
import {StringBuf} from "../StringBuf"
import {Std} from "../Std"
import {HxOverrides} from "../HxOverrides"
import {EReg} from "../EReg"

/**
Elements return by `CallStack` methods.
*/
export const StackItem = 
Register.global("$hxEnums")["haxe.StackItem"] = 
{
	__ename__: "haxe.StackItem",
	
	CFunction: {_hx_name: "CFunction", _hx_index: 0, __enum__: "haxe.StackItem"},
	Module: Object.assign((m) => ({_hx_index: 1, __enum__: "haxe.StackItem", m}), {_hx_name: "Module", __params__: ["m"]}),
	FilePos: Object.assign((s, file, line, column) => ({_hx_index: 2, __enum__: "haxe.StackItem", s, file, line, column}), {_hx_name: "FilePos", __params__: ["s", "file", "line", "column"]}),
	Method: Object.assign((classname, method) => ({_hx_index: 3, __enum__: "haxe.StackItem", classname, method}), {_hx_name: "Method", __params__: ["classname", "method"]}),
	LocalFunction: Object.assign((v) => ({_hx_index: 4, __enum__: "haxe.StackItem", v}), {_hx_name: "LocalFunction", __params__: ["v"]})
}
StackItem.__constructs__ = ["CFunction", "Module", "FilePos", "Method", "LocalFunction"]
StackItem.__empty_constructs__ = [StackItem.CFunction]

/**
Get information about the call stack.
*/
export const CallStack = Register.global("$hxClasses")["haxe.CallStack"] = 
class CallStack {
	static getStack(e) {
		if (e == null) {
			return [];
		};
		var oldValue = Error.prepareStackTrace;
		Error.prepareStackTrace = function (error, callsites) {
			var stack = [];
			var _g = 0;
			while (_g < callsites.length) {
				var site = callsites[_g];
				++_g;
				if (CallStack.wrapCallSite != null) {
					site = CallStack.wrapCallSite(site);
				};
				var method = null;
				var fullName = site.getFunctionName();
				if (fullName != null) {
					var idx = fullName.lastIndexOf(".");
					if (idx >= 0) {
						var className = HxOverrides.substr(fullName, 0, idx);
						var methodName = HxOverrides.substr(fullName, idx + 1, null);
						method = StackItem.Method(className, methodName);
					};
				};
				var fileName = site.getFileName();
				var fileAddr = (fileName == null) ? -1 : fileName.indexOf("file:");
				if (CallStack.wrapCallSite != null && fileAddr > 0) {
					fileName = HxOverrides.substr(fileName, fileAddr + 6, null);
				};
				stack.push(StackItem.FilePos(method, fileName, site.getLineNumber(), site.getColumnNumber()));
			};
			return stack;
		};
		var a = CallStack.makeStack(e.stack);
		Error.prepareStackTrace = oldValue;
		return a;
	}
	
	/**
	Return the call stack elements, or an empty array if not available.
	*/
	static callStack() {
		try {
			throw new Error();
		}catch (e) {
			CallStack.lastException = e;
			var e1 = (((e) instanceof HaxeError)) ? e.val : e;
			var a = CallStack.getStack(e);
			a.shift();
			return a;
		};
	}
	
	/**
	Return the exception stack : this is the stack elements between
	the place the last exception was thrown and the place it was
	caught, or an empty array if not available.
	*/
	static exceptionStack() {
		return CallStack.getStack(CallStack.lastException);
	}
	
	/**
	Returns a representation of the stack as a printable string.
	*/
	static toString(stack) {
		var b = new StringBuf();
		var _g = 0;
		while (_g < stack.length) {
			var s = stack[_g];
			++_g;
			b.b += "\nCalled from ";
			CallStack.itemToString(b, s);
		};
		return b.b;
	}
	static itemToString(b, s) {
		switch (s._hx_index) {
			case 0:
				b.b += "a C function";
				break
			case 1:
				var m = s.m;
				b.b += "module ";
				b.b += (m == null) ? "null" : "" + m;
				break
			case 2:
				var col = s.column;
				var line = s.line;
				var file = s.file;
				var s1 = s.s;
				if (s1 != null) {
					CallStack.itemToString(b, s1);
					b.b += " (";
				};
				b.b += (file == null) ? "null" : "" + file;
				b.b += " line ";
				b.b += (line == null) ? "null" : "" + line;
				if (col != null) {
					b.b += " column ";
					b.b += (col == null) ? "null" : "" + col;
				};
				if (s1 != null) {
					b.b += ")";
				};
				break
			case 3:
				var meth = s.method;
				var cname = s.classname;
				b.b += Std.string((cname == null) ? "<unknown>" : cname);
				b.b += ".";
				b.b += (meth == null) ? "null" : "" + meth;
				break
			case 4:
				var n = s.v;
				b.b += "local function #";
				b.b += (n == null) ? "null" : "" + n;
				break
			
		};
	}
	static makeStack(s) {
		if (s == null) {
			return [];
		} else if (typeof(s) == "string") {
			var stack = s.split("\n");
			if (stack[0] == "Error") {
				stack.shift();
			};
			var m = [];
			var rie10 = new EReg("^   at ([A-Za-z0-9_. ]+) \\(([^)]+):([0-9]+):([0-9]+)\\)$", "");
			var _g = 0;
			while (_g < stack.length) {
				var line = stack[_g];
				++_g;
				if (rie10.match(line)) {
					var path = rie10.matched(1).split(".");
					var meth = path.pop();
					var file = rie10.matched(2);
					var line1 = Std.parseInt(rie10.matched(3));
					var column = Std.parseInt(rie10.matched(4));
					m.push(StackItem.FilePos((meth == "Anonymous function") ? StackItem.LocalFunction() : (meth == "Global code") ? null : StackItem.Method(path.join("."), meth), file, line1, column));
				} else {
					m.push(StackItem.Module(StringTools.trim(line)));
				};
			};
			return m;
		} else {
			return s;
		};
	}
	static get __name__() {
		return "haxe.CallStack"
	}
	get __class__() {
		return CallStack
	}
}


//# sourceMappingURL=CallStack.js.map