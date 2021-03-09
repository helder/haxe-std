import {Encoding} from "../io/Encoding.js"
import {Exception} from "../Exception.js"
import {Register} from "../../genes/Register.js"
import {Reflect} from "../../Reflect.js"

/**
This class can be used to handle Http requests consistently across
platforms. There are two intended usages:

- call `haxe.Http.requestUrl(url)` and receive the result as a `String`
(not available on flash)
- create a `new haxe.Http(url)`, register your callbacks for `onData`,
`onError` and `onStatus`, then call `request()`.
*/
export const HttpBase = Register.global("$hxClasses")["haxe.http.HttpBase"] = 
class HttpBase extends Register.inherits() {
	new(url) {
		this.url = url;
		this.headers = [];
		this.params = [];
		this.emptyOnData = Register.bind(this, this.onData);
	}
	get responseData() {
		return this.get_responseData()
	}
	
	/**
	Sets the header identified as `header` to value `value`.
	
	If `header` or `value` are null, the result is unspecified.
	
	This method provides a fluent interface.
	*/
	setHeader(name, value) {
		let _g = 0;
		let _g1 = this.headers.length;
		while (_g < _g1) {
			let i = _g++;
			if (this.headers[i].name == name) {
				this.headers[i] = {"name": name, "value": value};
				return;
			};
		};
		this.headers.push({"name": name, "value": value});
	}
	addHeader(header, value) {
		this.headers.push({"name": header, "value": value});
	}
	
	/**
	Sets the parameter identified as `param` to value `value`.
	
	If `header` or `value` are null, the result is unspecified.
	
	This method provides a fluent interface.
	*/
	setParameter(name, value) {
		let _g = 0;
		let _g1 = this.params.length;
		while (_g < _g1) {
			let i = _g++;
			if (this.params[i].name == name) {
				this.params[i] = {"name": name, "value": value};
				return;
			};
		};
		this.params.push({"name": name, "value": value});
	}
	addParameter(name, value) {
		this.params.push({"name": name, "value": value});
	}
	
	/**
	Sets the post data of `this` Http request to `data` string.
	
	There can only be one post data per request. Subsequent calls to
	this method or to `setPostBytes()` overwrite the previously set value.
	
	If `data` is null, the post data is considered to be absent.
	
	This method provides a fluent interface.
	*/
	setPostData(data) {
		this.postData = data;
		this.postBytes = null;
	}
	
	/**
	Sets the post data of `this` Http request to `data` bytes.
	
	There can only be one post data per request. Subsequent calls to
	this method or to `setPostData()` overwrite the previously set value.
	
	If `data` is null, the post data is considered to be absent.
	
	This method provides a fluent interface.
	*/
	setPostBytes(data) {
		this.postBytes = data;
		this.postData = null;
	}
	
	/**
	Sends `this` Http request to the Url specified by `this.url`.
	
	If `post` is true, the request is sent as POST request, otherwise it is
	sent as GET request.
	
	Depending on the outcome of the request, this method calls the
	`onStatus()`, `onError()`, `onData()` or `onBytes()` callback functions.
	
	If `this.url` is null, the result is unspecified.
	
	If `this.url` is an invalid or inaccessible Url, the `onError()` callback
	function is called.
	
	[js] If `this.async` is false, the callback functions are called before
	this method returns.
	*/
	request(post = null) {
		throw Exception.thrown("not implemented");
	}
	
	/**
	This method is called upon a successful request, with `data` containing
	the result String.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onData = function(data) { // handle result }`
	*/
	onData(data) {
	}
	
	/**
	This method is called upon a successful request, with `data` containing
	the result String.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onBytes = function(data) { // handle result }`
	*/
	onBytes(data) {
	}
	
	/**
	This method is called upon a request error, with `msg` containing the
	error description.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onError = function(msg) { // handle error }`
	*/
	onError(msg) {
	}
	
	/**
	This method is called upon a Http status change, with `status` being the
	new status.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onStatus = function(status) { // handle status }`
	*/
	onStatus(status) {
	}
	
	/**
	Override this if extending `haxe.Http` with overriding `onData`
	*/
	hasOnData() {
		return !Reflect.compareMethods(Register.bind(this, this.onData), this.emptyOnData);
	}
	success(data) {
		this.responseBytes = data;
		this.responseAsString = null;
		if (this.hasOnData()) {
			this.onData(this.get_responseData());
		};
		this.onBytes(this.responseBytes);
	}
	get_responseData() {
		if (this.responseAsString == null && this.responseBytes != null) {
			this.responseAsString = this.responseBytes.getString(0, this.responseBytes.length, Encoding.UTF8);
		};
		return this.responseAsString;
	}
	static get __name__() {
		return "haxe.http.HttpBase"
	}
	get __class__() {
		return HttpBase
	}
}


//# sourceMappingURL=HttpBase.js.map