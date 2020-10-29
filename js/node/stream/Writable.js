import {Register} from "../../../genes/Register"

export const WritableNewOptionsAdapter_Impl_ = Register.global("$hxClasses")["js.node.stream._Writable.WritableNewOptionsAdapter_Impl_"] = 
class WritableNewOptionsAdapter_Impl_ {
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
		return WritableNewOptionsAdapter_Impl_
	}
}


//# sourceMappingURL=Writable.js.map