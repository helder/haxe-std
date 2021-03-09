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
		var parsedUrl = Url.parse(this.url);
		var _gthis = this;
		var secure = parsedUrl.protocol == "https:";
		var host = parsedUrl.hostname;
		var path = parsedUrl.path;
		var port = (parsedUrl.port != null) ? Std.parseInt(parsedUrl.port) : (secure) ? 443 : 80;
		var h = {};
		var _g = 0;
		var _g1 = this.headers;
		while (_g < _g1.length) {
			var i = _g1[_g];
			++_g;
			var arr = Reflect.field(h, i.name);
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
		var _g2 = 0;
		var _g3 = this.params;
		while (_g2 < _g3.length) {
			var p = _g3[_g2];
			++_g2;
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
			var s2 = res.statusCode;
			if (s2 != null) {
				_gthis.onStatus(s2);
			};
			var data = [];
			res.on("data", function (chunk) {
				var httpResponse1 = Buffer.from(chunk, "binary");
				data.push(httpResponse1);
			});
			res.on("end", function (_) {
				var buf = (data.length == 1) ? data[0] : Buffer.concat(data);
				var httpResponse2 = buf.buffer.slice(buf.byteOffset, buf.byteOffset + buf.byteLength);
				_gthis.responseBytes = Bytes.ofData(httpResponse2);
				_gthis.req = null;
				if (s2 != null && s2 >= 200 && s2 < 400) {
					_gthis.success(_gthis.responseBytes);
				} else {
					_gthis.onError("Http Error #" + s2);
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