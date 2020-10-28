import {ClientRequest} from "http"
import {HttpBase} from "./HttpBase"

export declare class HttpNodeJs extends HttpBase {
	constructor(url: string)
	
	/**
	Cancels `this` Http request if `request` has been called and a response
	has not yet been received.
	*/
	cancel(): void
	request(post?: null | boolean): void
}

//# sourceMappingURL=HttpNodeJs.d.ts.map