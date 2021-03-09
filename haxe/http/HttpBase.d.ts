import {Bytes} from "../io/Bytes"

export type StringKeyValue = {name: string, value: string}

/**
This class can be used to handle Http requests consistently across
platforms. There are two intended usages:

- call `haxe.Http.requestUrl(url)` and receive the result as a `String`
(not available on flash)
- create a `new haxe.Http(url)`, register your callbacks for `onData`,
`onError` and `onStatus`, then call `request()`.
*/
export declare class HttpBase {
	constructor(url: string)
	
	/**
	The url of `this` request. It is used only by the `request()` method and
	can be changed in order to send the same request to different target
	Urls.
	*/
	url: string
	readonly responseData: null | string
	responseBytes: null | Bytes
	
	/**
	Sets the header identified as `header` to value `value`.
	
	If `header` or `value` are null, the result is unspecified.
	
	This method provides a fluent interface.
	*/
	setHeader(name: string, value: string): void
	addHeader(header: string, value: string): void
	
	/**
	Sets the parameter identified as `param` to value `value`.
	
	If `header` or `value` are null, the result is unspecified.
	
	This method provides a fluent interface.
	*/
	setParameter(name: string, value: string): void
	addParameter(name: string, value: string): void
	
	/**
	Sets the post data of `this` Http request to `data` string.
	
	There can only be one post data per request. Subsequent calls to
	this method or to `setPostBytes()` overwrite the previously set value.
	
	If `data` is null, the post data is considered to be absent.
	
	This method provides a fluent interface.
	*/
	setPostData(data: null | string): void
	
	/**
	Sets the post data of `this` Http request to `data` bytes.
	
	There can only be one post data per request. Subsequent calls to
	this method or to `setPostData()` overwrite the previously set value.
	
	If `data` is null, the post data is considered to be absent.
	
	This method provides a fluent interface.
	*/
	setPostBytes(data: null | Bytes): void
	
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
	request(post?: null | boolean): void
	
	/**
	This method is called upon a successful request, with `data` containing
	the result String.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onData = function(data) { // handle result }`
	*/
	onData(data: string): void
	
	/**
	This method is called upon a successful request, with `data` containing
	the result String.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onBytes = function(data) { // handle result }`
	*/
	onBytes(data: Bytes): void
	
	/**
	This method is called upon a request error, with `msg` containing the
	error description.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onError = function(msg) { // handle error }`
	*/
	onError(msg: string): void
	
	/**
	This method is called upon a Http status change, with `status` being the
	new status.
	
	The intended usage is to bind it to a custom function:
	`httpInstance.onStatus = function(status) { // handle status }`
	*/
	onStatus(status: number): void
}

//# sourceMappingURL=HttpBase.d.ts.map