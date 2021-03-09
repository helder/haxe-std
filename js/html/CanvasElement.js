import {Register} from "../../genes/Register.js"

export const CanvasUtil = Register.global("$hxClasses")["js.html._CanvasElement.CanvasUtil"] = 
class CanvasUtil {
	static getContextWebGL(canvas, attribs) {
		var name = "webgl";
		var ctx = canvas.getContext(name, attribs);
		if (ctx != null) {
			return ctx;
		};
		var name1 = "experimental-webgl";
		var ctx1 = canvas.getContext(name1, attribs);
		if (ctx1 != null) {
			return ctx1;
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