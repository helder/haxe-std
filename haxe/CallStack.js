import {NativeStackTrace} from "./NativeStackTrace.js"
import {Register} from "../genes/Register.js"
import {StringBuf} from "../StringBuf.js"
import {Std} from "../Std.js"

const $global = Register.$global

/**
Elements return by `CallStack` methods.
*/
export const StackItem = 
Register.global("$hxEnums")["haxe.StackItem"] = 
{
	__ename__: "haxe.StackItem",
	
	CFunction: {_hx_name: "CFunction", _hx_index: 0, __enum__: "haxe.StackItem"},
	Module: Object.assign((m) => ({_hx_index: 1, __enum__: "haxe.StackItem", "m": m}), {_hx_name: "Module", __params__: ["m"]}),
	FilePos: Object.assign((s, file, line, column) => ({_hx_index: 2, __enum__: "haxe.StackItem", "s": s, "file": file, "line": line, "column": column}), {_hx_name: "FilePos", __params__: ["s", "file", "line", "column"]}),
	Method: Object.assign((classname, method) => ({_hx_index: 3, __enum__: "haxe.StackItem", "classname": classname, "method": method}), {_hx_name: "Method", __params__: ["classname", "method"]}),
	LocalFunction: Object.assign((v) => ({_hx_index: 4, __enum__: "haxe.StackItem", "v": v}), {_hx_name: "LocalFunction", __params__: ["v"]})
}
StackItem.__constructs__ = [StackItem.CFunction, StackItem.Module, StackItem.FilePos, StackItem.Method, StackItem.LocalFunction]
StackItem.__empty_constructs__ = [StackItem.CFunction]

export const CallStack = Register.global("$hxClasses")["haxe._CallStack.CallStack"] = 
class CallStack {
	static get length() {
		return this.get_length()
	}
	static get_length(this1) {
		return this1.length;
	}
	
	/**
	Return the call stack elements, or an empty array if not available.
	*/
	static callStack() {
		return NativeStackTrace.toHaxe(NativeStackTrace.callStack());
	}
	
	/**
	Return the exception stack : this is the stack elements between
	the place the last exception was thrown and the place it was
	caught, or an empty array if not available.
	Set `fullStack` parameter to true in order to return the full exception stack.
	
	May not work if catch type was a derivative from `haxe.Exception`.
	*/
	static exceptionStack(fullStack) {
		if (fullStack == null) {
			fullStack = false;
		};
		var eStack = NativeStackTrace.toHaxe(NativeStackTrace.exceptionStack());
		return (fullStack) ? eStack : CallStack.subtract(eStack, CallStack.callStack());
	}
	
	/**
	Returns a representation of the stack as a printable string.
	*/
	static toString(stack) {
		var b = new StringBuf();
		var _g = 0;
		var _g1 = stack;
		while (_g < _g1.length) {
			var s = _g1[_g];
			++_g;
			b.b += "\nCalled from ";
			CallStack.itemToString(b, s);
		};
		return b.b;
	}
	
	/**
	Returns a range of entries of current stack from the beginning to the the
	common part of this and `stack`.
	*/
	static subtract(this1, stack) {
		var startIndex = -1;
		var i = -1;
		while (++i < this1.length) {
			var _g = 0;
			var _g1 = stack.length;
			while (_g < _g1) {
				var j = _g++;
				if (CallStack.equalItems(this1[i], stack[j])) {
					if (startIndex < 0) {
						startIndex = i;
					};
					++i;
					if (i >= this1.length) {
						break;
					};
				} else {
					startIndex = -1;
				};
			};
			if (startIndex >= 0) {
				break;
			};
		};
		if (startIndex >= 0) {
			return this1.slice(0, startIndex);
		} else {
			return this1;
		};
	}
	
	/**
	Make a copy of the stack.
	*/
	static copy(this1) {
		return this1.slice();
	}
	static get(this1, index) {
		return this1[index];
	}
	static asArray(this1) {
		return this1;
	}
	static equalItems(item1, item2) {
		if (item1 == null) {
			if (item2 == null) {
				return true;
			} else {
				return false;
			};
		} else {
			switch (item1._hx_index) {
				case 0:
					if (item2 == null) {
						return false;
					} else if (item2._hx_index == 0) {
						return true;
					} else {
						return false;
					};
					break
				case 1:
					if (item2 == null) {
						return false;
					} else if (item2._hx_index == 1) {
						var m2 = item2.m;
						var m1 = item1.m;
						return m1 == m2;
					} else {
						return false;
					};
					break
				case 2:
					if (item2 == null) {
						return false;
					} else if (item2._hx_index == 2) {
						var item21 = item2.s;
						var file2 = item2.file;
						var line2 = item2.line;
						var col2 = item2.column;
						var col1 = item1.column;
						var line1 = item1.line;
						var file1 = item1.file;
						var item11 = item1.s;
						if (file1 == file2 && line1 == line2 && col1 == col2) {
							return CallStack.equalItems(item11, item21);
						} else {
							return false;
						};
					} else {
						return false;
					};
					break
				case 3:
					if (item2 == null) {
						return false;
					} else if (item2._hx_index == 3) {
						var class2 = item2.classname;
						var method2 = item2.method;
						var method1 = item1.method;
						var class1 = item1.classname;
						if (class1 == class2) {
							return method1 == method2;
						} else {
							return false;
						};
					} else {
						return false;
					};
					break
				case 4:
					if (item2 == null) {
						return false;
					} else if (item2._hx_index == 4) {
						var v2 = item2.v;
						var v1 = item1.v;
						return v1 == v2;
					} else {
						return false;
					};
					break
				
			};
		};
	}
	static exceptionToString(e) {
		if (e.get_previous() == null) {
			var tmp = "Exception: " + e.toString();
			var tmp1 = e.get_stack();
			return tmp + ((tmp1 == null) ? "null" : CallStack.toString(tmp1));
		};
		var result = "";
		var e1 = e;
		var prev = null;
		while (e1 != null) {
			if (prev == null) {
				var result1 = "Exception: " + e1.get_message();
				var tmp = e1.get_stack();
				result = result1 + ((tmp == null) ? "null" : CallStack.toString(tmp)) + result;
			} else {
				var prevStack = CallStack.subtract(e1.get_stack(), prev.get_stack());
				result = "Exception: " + e1.get_message() + ((prevStack == null) ? "null" : CallStack.toString(prevStack)) + "\n\nNext " + result;
			};
			prev = e1;
			e1 = e1.get_previous();
		};
		return result;
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
				var s1 = s.s;
				var file = s.file;
				var line = s.line;
				var col = s.column;
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
				var cname = s.classname;
				var meth = s.method;
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
	static get __name__() {
		return "haxe._CallStack.CallStack_Impl_"
	}
	get __class__() {
		return CallStack
	}
}


//# sourceMappingURL=CallStack.js.map