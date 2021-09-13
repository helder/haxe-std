
/**
If `haxe.MainLoop` is kept from DCE, then we will insert an `haxe.EntryPoint.run()` call just at then end of `main()`.
This class can be redefined by custom frameworks so they can handle their own main loop logic.
*/
export declare class EntryPoint {
	protected static pending: (() => void)[]
	static threadCount: number
	
	/**
	Wakeup a sleeping `run()`
	*/
	static wakeup(): void
	static runInMainThread(f: (() => void)): void
	static addThread(f: (() => void)): void
	protected static processEvents(): number
	
	/**
	Start the main loop. Depending on the platform, this can return immediately or will only return when the application exits.
	*/
	static run(): void
}

//# sourceMappingURL=EntryPoint.d.ts.map