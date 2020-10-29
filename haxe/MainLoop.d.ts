
export declare class MainEvent {
	
	/**
	Tells if the event can lock the process from exiting (default:true)
	*/
	isBlocking: boolean
	nextRun: number
	priority: number
	
	/**
	Delay the execution of the event for the given time, in seconds.
	If t is null, the event will be run at tick() time.
	*/
	delay(t: null | number): void
	
	/**
	Call the event. Will do nothing if the event has been stopped.
	*/
	call(): void
	
	/**
	Stop the event from firing anymore.
	*/
	stop(): void
}

export declare class MainLoop {
	static readonly threadCount: number
	static hasEvents(): boolean
	static addThread(f: (() => void)): void
	static runInMainThread(f: (() => void)): void
	
	/**
	Add a pending event to be run into the main loop.
	*/
	static add(f: (() => void), priority?: number): MainEvent
}

//# sourceMappingURL=MainLoop.d.ts.map