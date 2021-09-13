import {Register} from "../../../genes/Register.js"

const $global = Register.$global

export const WritableNewOptionsAdapter = Register.global("$hxClasses")["js.node.stream._Writable.WritableNewOptionsAdapter"] = 
class WritableNewOptionsAdapter {
	static from(options) {
		if (!Object.prototype.hasOwnProperty.call(options, "final")) {
			Object.defineProperty(options, "final", {"get": function () {
				return options.final_;
			}});
		};
		return options;
	}
	static get __name__() {
		return "js.node.stream._Writable.WritableNewOptionsAdapter_Impl_"
	}
	get __class__() {
		return WritableNewOptionsAdapter
	}
}


//# sourceMappingURL=Writable.js.map