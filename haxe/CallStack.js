import {NativeStackTrace} from "./NativeStackTrace.js"
import {Register} from "../genes/Register.js"
import {StringBuf} from "../StringBuf.js"
import {Std} from "../Std.js"

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

export const CallStack_Impl_ = Register.global("$hxClasses")["haxe._CallStack.CallStack_Impl_"] = 
class CallStack_Impl_ {
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
	
	May not work if catch type was a derivative from `haxe.Exception`.
	*/
	static exceptionStack() {
		let eStack = NativeStackTrace.toHaxe(NativeStackTrace.exceptionStack());
		return CallStack_Impl_.subtract(eStack, CallStack_Impl_.callStack());
	}
	
	/**
	Returns a representation of the stack as a printable string.
	*/
	static toString(stack) {
		let b = new StringBuf();
		let _g = 0;
		let _g1 = stack;
		while (_g < _g1.length) {
			let s = _g1[_g];
			++_g;
			b.b += "\nCalled from ";
			CallStack_Impl_.itemToString(b, s);
		};
		return b.b;
	}
	
	/**
	Returns a range of entries of current stack from the beginning to the the
	common part of this and `stack`.
	*/
	static subtract(this1, stack) {
		let startIndex = -1;
		let i = -1;
		while (++i < this1.length) {
			let _g = 0;
			let _g1 = stack.length;
			while (_g < _g1) {
				let j = _g++;
				if (CallStack_Impl_.equalItems(this1[i], stack[j])) {
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
						let m1 = item1.m;
						let m2 = item2.m;
						return m1 == m2;
					} else {
						return false;
					};
					break
				case 2:
					if (item2 == null) {
						return false;
					} else if (item2._hx_index == 2) {
						let item11 = item1.s;
						let file1 = item1.file;
						let line1 = item1.line;
						let col1 = item1.column;
						let col2 = item2.column;
						let line2 = item2.line;
						let file2 = item2.file;
						let item21 = item2.s;
						if (file1 == file2 && line1 == line2 && col1 == col2) {
							return CallStack_Impl_.equalItems(item11, item21);
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
						let class1 = item1.classname;
						let method1 = item1.method;
						let method2 = item2.method;
						let class2 = item2.classname;
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
						let v1 = item1.v;
						let v2 = item2.v;
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
			let tmp = "Exception: " + e.get_message();
			let tmp1 = e.get_stack();
			return tmp + ((tmp1 == null) ? "null" : CallStack_Impl_.toString(tmp1));
		};
		let result = "";
		let e1 = e;
		let prev = null;
		while (e1 != null) {
			if (prev == null) {
				let result1 = "Exception: " + e1.get_message();
				let tmp = e1.get_stack();
				result = result1 + ((tmp == null) ? "null" : CallStack_Impl_.toString(tmp)) + result;
			} else {
				let prevStack = CallStack_Impl_.subtract(e1.get_stack(), prev.get_stack());
				result = "Exception: " + e1.get_message() + ((prevStack == null) ? "null" : CallStack_Impl_.toString(prevStack)) + "\n\nNext " + result;
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
				let m = s.m;
				b.b += "module ";
				b.b += (m == null) ? "null" : "" + m;
				break
			case 2:
				let col = s.column;
				let line = s.line;
				let file = s.file;
				let s1 = s.s;
				if (s1 != null) {
					CallStack_Impl_.itemToString(b, s1);
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
				let meth = s.method;
				let cname = s.classname;
				b.b += Std.string((cname == null) ? "<unknown>" : cname);
				b.b += ".";
				b.b += (meth == null) ? "null" : "" + meth;
				break
			case 4:
				let n = s.v;
				b.b += "local function #";
				b.b += (n == null) ? "null" : "" + n;
				break
			
		};
	}
	static get __name__() {
		return "haxe._CallStack.CallStack_Impl_"
	}
	get __class__() {
		return CallStack_Impl_
	}
}


//# sourceMappingURL=CallStack.js.map