import {Lib} from "./Lib.js"
import {Register} from "../genes/Register.js"
import {Std} from "../Std.js"

export const Selection = Register.global("$hxClasses")["js.Selection"] = 
class Selection extends Register.inherits() {
	new(doc) {
		this.doc = doc;
	}
	get() {
		if (this.doc.selectionStart != null) {
			return this.doc.value.substring(this.doc.selectionStart, this.doc.selectionEnd);
		};
		let range = Lib.document.selection.createRange();
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
		let value = this.doc.value;
		let p = 0;
		let delta = 0;
		while (true) {
			let i = value.indexOf("\r\n", p);
			if (i < 0 || i > start) {
				break;
			};
			++delta;
			p = i + 2;
		};
		start -= delta;
		while (true) {
			let i = value.indexOf("\r\n", p);
			if (i < 0 || i > end) {
				break;
			};
			++delta;
			p = i + 2;
		};
		end -= delta;
		let r = this.doc.createTextRange();
		r.moveEnd("textedit", -1);
		r.moveStart("character", start);
		r.moveEnd("character", end - start);
		r.select();
	}
	insert(left, text, right) {
		this.doc.focus();
		if (this.doc.selectionStart != null) {
			let top = this.doc.scrollTop;
			let start = this.doc.selectionStart;
			let end = this.doc.selectionEnd;
			let tmp = Std.string(this.doc.value.substr(0, start)) + left + text + right;
			let tmp1 = Std.string(this.doc.value.substr(end));
			this.doc.value = tmp + tmp1;
			this.doc.selectionStart = start + left.length;
			this.doc.selectionEnd = start + left.length + text.length;
			this.doc.scrollTop = top;
			return;
		};
		let range = Lib.document.selection.createRange();
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