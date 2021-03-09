import * as Url from "url"
import * as Https from "https"
import * as Http from "http"
import {Bytes} from "../io/Bytes.js"
import {HttpBase} from "./HttpBase.js"
import {Register} from "../../genes/Register.js"
import {Buffer} from "buffer"
import {Std} from "../../Std.js"
import {Reflect} from "../../Reflect.js"

export const HttpNodeJs = Register.global("$hxClasses")["haxe.http.HttpNodeJs"] = 
class HttpNodeJs extends Register.inherits(HttpBase) {
	new(url) {
		super.new(url);
	}
	
	/**
	Cancels `this` Http request if `request` has been called and a response
	has not yet been received.
	*/
	cancel() {
		if (this.req == null) {
			return;
		};
		this.req.abort();
		this.req = null;
	}
	request(post = null) {
		this.responseAsString = null;
		this.responseBytes = null;
		let parsedUrl = Url.parse(this.url);
		let _gthis = this;
		let secure = parsedUrl.protocol == "https:";
		let host = parsedUrl.hostname;
		let path = parsedUrl.path;
		let port = (parsedUrl.port != null) ? Std.parseInt(parsedUrl.port) : (secure) ? 443 : 80;
		let h = {};
		let _g = 0;
		let _g1 = this.headers;
		while (_g < _g1.length) {
			let i = _g1[_g];
			++_g;
			let arr = Reflect.field(h, i.name);
			if (arr == null) {
				arr = new Array();
				h[i.name] = arr;
			};
			arr.push(i.value);
		};
		if (this.postData != null || this.postBytes != null) {
			post = true;
		};
		let uri = null;
		let _g2 = 0;
		let _g3 = this.params;
		while (_g2 < _g3.length) {
			let p = _g3[_g2];
			++_g2;
			if (uri == null) {
				uri = "";
			} else {
				uri += "&";
			};
			let s = p.name;
			let uri1 = encodeURIComponent(s) + "=";
			let s1 = p.value;
			uri += uri1 + encodeURIComponent(s1);
		};
		let question = path.split("?").length <= 1;
		if (uri != null) {
			path += ((question) ? "?" : "&") + uri;
		};
		let opts = {"protocol": parsedUrl.protocol, "hostname": host, "port": port, "method": (post) ? "POST" : "GET", "path": path, "headers": h};
		let httpResponse = function (res) {
			res.setEncoding("binary");
			let s = res.statusCode;
			if (s != null) {
				_gthis.onStatus(s);
			};
			let data = [];
			res.on("data", function (chunk) {
				data.push(Buffer.from(chunk, "binary"));
			});
			res.on("end", function (_) {
				let buf = (data.length == 1) ? data[0] : Buffer.concat(data);
				let httpResponse = buf.buffer.slice(buf.byteOffset, buf.byteOffset + buf.byteLength);
				_gthis.responseBytes = Bytes.ofData(httpResponse);
				_gthis.req = null;
				if (s != null && s >= 200 && s < 400) {
					_gthis.success(_gthis.responseBytes);
				} else {
					_gthis.onError("Http Error #" + s);
				};
			});
		};
		this.req = (secure) ? Https.request(opts, httpResponse) : Http.request(opts, httpResponse);
		if (post) {
			if (this.postData != null) {
				this.req.write(this.postData);
			} else if (this.postBytes != null) {
				this.req.setHeader("Content-Length", "" + this.postBytes.length);
				this.req.write(Buffer.from(this.postBytes.b.bufferValue));
			};
		};
		this.req.end();
	}
	static get __name__() {
		return "haxe.http.HttpNodeJs"
	}
	static get __super__() {
		return HttpBase
	}
	get __class__() {
		return HttpNodeJs
	}
}


//# sourceMappingURL=HttpNodeJs.js.map