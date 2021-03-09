
export class Register {
	static global(name) {
		if (Register.globals[name]) {
			return Register.globals[name];
		} else {
			return Register.globals[name] = {};
		};
	}
	static createStatic(obj, name, get) {
		var value = null;
		Object.defineProperty(obj, name, {"enumerable": true, "get": function () {
			if (get != null) {
				value = get();
				get = null;
			};
			return value;
		}, "set": function (v) {
			if (get != null) {
				value = get();
				get = null;
			};
			value = v;
			return value;
		}});
	}
	static iter(a) {
		if (!Array.isArray(a)) {
			return a.iterator();
		} else {
			return {"cur": 0, "arr": a, "hasNext": function () {
				return this.cur < this.arr.length;
			}, "next": function () {
				return this.arr[this.cur++];
			}};
		};
	}
	static extend(superClass) {
		
      function res() {
        this.new.apply(this, arguments)
      }
      Object.setPrototypeOf(res.prototype, superClass.prototype)
      return res
    ;
	}
	static inherits(resolve, defer = false) {
		
      function res() {
        if (defer && resolve && res.__init__) res.__init__()
        this.new.apply(this, arguments)
      }
      if (!defer) {
        if (resolve && resolve.__init__) {
          defer = true
          res.__init__ = () => {
            resolve.__init__()
            Object.setPrototypeOf(res.prototype, resolve.prototype)
            res.__init__ = undefined
          } 
        } else if (resolve) {
          Object.setPrototypeOf(res.prototype, resolve.prototype)
        }
      } else {
        res.__init__ = () => {
          const superClass = resolve()
          if (superClass.__init__) superClass.__init__()
          Object.setPrototypeOf(res.prototype, superClass.prototype)
          res.__init__ = undefined
        } 
      }
      return res
    ;
	}
	static bind(o, m) {
		if (m == null) {
			return null;
		};
		if (m.__id__ == null) {
			m.__id__ = Register.fid++;
		};
		var f = null;
		if (o.hx__closures__ == null) {
			o.hx__closures__ = {};
		} else {
			f = o.hx__closures__[m.__id__];
		};
		if (f == null) {
			f = m.bind(o);
			o.hx__closures__[m.__id__] = f;
		};
		return f;
	}
	static get __name__() {
		return "genes.Register"
	}
	get __class__() {
		return Register
	}
}


Register.$global = typeof window != "undefined" ? window : typeof global != "undefined" ? global : typeof self != "undefined" ? self : this
Register.globals = {}
Register.fid = 0
//# sourceMappingURL=Register.js.map