
export declare class Browser {
	
	/**
	The global scope typed with fields available only in a worker context.
	*/
	static readonly self: WorkerGlobalScope
	
	/**
	The global window object.
	*/
	static window: Window
	
	/**
	Shortcut to Window.document.
	*/
	static document: HTMLDocument
	
	/**
	Shortcut to Window.location.
	*/
	static location: Location
	
	/**
	Shortcut to Window.navigator.
	*/
	static navigator: Navigator
	
	/**
	Shortcut to Window.console.
	*/
	static console: ConsoleInstance
	
	/**
	* True if a window object exists, false otherwise.
	*
	* This can be used to check if the code is being executed in a non-browser
	* environment such as node.js.
	*/
	static supported: boolean
	
	/**
	* Safely gets the browser's local storage, or returns null if localStorage is unsupported or
	* disabled.
	*/
	static getLocalStorage(): Storage
	
	/**
	* Safely gets the browser's session storage, or returns null if sessionStorage is unsupported
	* or disabled.
	*/
	static getSessionStorage(): Storage
	
	/**
	* Creates an XMLHttpRequest, with a fallback to ActiveXObject for ancient versions of Internet
	* Explorer.
	*/
	static createXMLHttpRequest(): XMLHttpRequest
	
	/**
	Display an alert message box containing the given message. See also `Window.alert()`.
	*/
	static alert(v: any): void
}

//# sourceMappingURL=Browser.d.ts.map