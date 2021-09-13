import {URL} from "url"
import * as Https from "https"
import * as Http from "http"
import {Bytes} from "../io/Bytes.js"
import {HttpBase} from "./HttpBase.js"
import {Register} from "../../genes/Register.js"
import {Buffer} from "buffer"
import {Std} from "../../Std.js"
import {Reflect as Reflect__1} from "../../Reflect.js"

const $global = Register.$global

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
	request(post) {
		var _gthis = this;
		this.responseAsString = null;
		this.responseBytes = null;
		var parsedUrl = new URL(this.url);
		var secure = parsedUrl.protocol == "https:";
		var host = parsedUrl.hostname;
		var path = parsedUrl.pathname;
		var port = (parsedUrl.port != null) ? Std.parseInt(parsedUrl.port) : (secure) ? 443 : 80;
		var h = {};
		var _g = 0;
		var _g1 = this.headers;
		while (_g < _g1.length) {
			var i = _g1[_g];
			++_g;
			var arr = Reflect__1.field(h, i.name);
			if (arr == null) {
				arr = new Array();
				h[i.name] = arr;
			};
			arr.push(i.value);
		};
		if (this.postData != null || this.postBytes != null) {
			post = true;
		};
		var uri = null;
		var _g = 0;
		var _g1 = this.params;
		while (_g < _g1.length) {
			var p = _g1[_g];
			++_g;
			if (uri == null) {
				uri = "";
			} else {
				uri += "&";
			};
			var s = p.name;
			var uri1 = encodeURIComponent(s) + "=";
			var s1 = p.value;
			uri += uri1 + encodeURIComponent(s1);
		};
		var question = path.split("?").length <= 1;
		if (uri != null) {
			path += ((question) ? "?" : "&") + uri;
		};
		var opts = {"protocol": parsedUrl.protocol, "hostname": host, "port": port, "method": (post) ? "POST" : "GET", "path": path, "headers": h};
		var httpResponse = function (res) {
			res.setEncoding("binary");
			var s = res.statusCode;
			if (s != null) {
				_gthis.onStatus(s);
			};
			var data = [];
			res.on("data", function (chunk) {
				data.push(Buffer.from(chunk, "binary"));
			});
			res.on("end", function (_) {
				var buf = (data.length == 1) ? data[0] : Buffer.concat(data);
				var httpResponse = buf.buffer.slice(buf.byteOffset, buf.byteOffset + buf.byteLength);
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