import {Register} from "../../genes/Register.js"

const $global = Register.$global

export const CanvasUtil = Register.global("$hxClasses")["js.html._CanvasElement.CanvasUtil"] = 
class CanvasUtil {
	static getContextWebGL(canvas, attribs) {
		var name = "webgl";
		var ctx = canvas.getContext(name, attribs);
		if (ctx != null) {
			return ctx;
		};
		var name = "experimental-webgl";
		var ctx = canvas.getContext(name, attribs);
		if (ctx != null) {
			return ctx;
		};
		return null;
	}
	static get __name__() {
		return "js.html._CanvasElement.CanvasUtil"
	}
	get __class__() {
		return CanvasUtil
	}
}


//# sourceMappingURL=CanvasElement.js.map