import {Lib} from "./Lib.js"
import {Register} from "../genes/Register.js"
import {Std} from "../Std.js"

const $global = Register.$global

export const Selection = Register.global("$hxClasses")["js.Selection"] = 
class Selection extends Register.inherits() {
	new(doc) {
		this.doc = doc;
	}
	get() {
		if (this.doc.selectionStart != null) {
			return this.doc.value.substring(this.doc.selectionStart, this.doc.selectionEnd);
		};
		var range = Lib.document.selection.createRange();
		if (range.parentElement() != this.doc) {
			return "";
		};
		return range.text;
	}
	select(start, end) {
		this.doc.focus();
		if (this.doc.selectionStart != null) {
			this.doc.selectionStart = start;
			this.doc.selectionEnd = end;
			return;
		};
		var value = this.doc.value;
		var p = 0;
		var delta = 0;
		while (true) {
			var i = value.indexOf("\r\n", p);
			if (i < 0 || i > start) {
				break;
			};
			++delta;
			p = i + 2;
		};
		start -= delta;
		while (true) {
			var i = value.indexOf("\r\n", p);
			if (i < 0 || i > end) {
				break;
			};
			++delta;
			p = i + 2;
		};
		end -= delta;
		var r = this.doc.createTextRange();
		r.moveEnd("textedit", -1);
		r.moveStart("character", start);
		r.moveEnd("character", end - start);
		r.select();
	}
	insert(left, text, right) {
		this.doc.focus();
		if (this.doc.selectionStart != null) {
			var top = this.doc.scrollTop;
			var start = this.doc.selectionStart;
			var end = this.doc.selectionEnd;
			var tmp = Std.string(this.doc.value.substr(0, start)) + left + text + right;
			var tmp1 = Std.string(this.doc.value.substr(end));
			this.doc.value = tmp + tmp1;
			this.doc.selectionStart = start + left.length;
			this.doc.selectionEnd = start + left.length + text.length;
			this.doc.scrollTop = top;
			return;
		};
		var range = Lib.document.selection.createRange();
		range.text = left + text + right;
		range.moveStart("character", -text.length - right.length);
		range.moveEnd("character", -right.length);
		range.select();
	}
	static get __name__() {
		return "js.Selection"
	}
	get __class__() {
		return Selection
	}
}


//# sourceMappingURL=Selection.js.map