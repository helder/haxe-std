
/**
The DateTools class contains some extra functionalities for handling `Date`
instances and timestamps.

In the context of Haxe dates, a timestamp is defined as the number of
milliseconds elapsed since 1st January 1970.
*/
export declare class DateTools {
	protected static DAY_SHORT_NAMES: string[]
	protected static DAY_NAMES: string[]
	protected static MONTH_SHORT_NAMES: string[]
	protected static MONTH_NAMES: string[]
	protected static __format_get(d: Date, e: string): string
	protected static __format(d: Date, f: string): string
	
	/**
	Format the date `d` according to the format `f`. The format is
	compatible with the `strftime` standard format, except that there is no
	support in Flash and JS for day and months names (due to lack of proper
	internationalization API). On Haxe/Neko/Windows, some formats are not
	supported.
	
	```haxe
	var t = DateTools.format(Date.now(), "%Y-%m-%d_%H:%M:%S");
	// 2016-07-08_14:44:05
	
	var t = DateTools.format(Date.now(), "%r");
	// 02:44:05 PM
	
	var t = DateTools.format(Date.now(), "%T");
	// 14:44:05
	
	var t = DateTools.format(Date.now(), "%F");
	// 2016-07-08
	```
	*/
	static format(d: Date, f: string): string
	
	/**
	Returns the result of adding timestamp `t` to Date `d`.
	
	This is a convenience function for calling
	`Date.fromTime(d.getTime() + t)`.
	*/
	static delta(d: Date, t: number): Date
	protected static DAYS_OF_MONTH: number[]
	
	/**
	Returns the number of days in the month of Date `d`.
	
	This method handles leap years.
	*/
	static getMonthDays(d: Date): number
	
	/**
	Converts a number of seconds to a timestamp.
	*/
	static seconds(n: number): number
	
	/**
	Converts a number of minutes to a timestamp.
	*/
	static minutes(n: number): number
	
	/**
	Converts a number of hours to a timestamp.
	*/
	static hours(n: number): number
	
	/**
	Converts a number of days to a timestamp.
	*/
	static days(n: number): number
	
	/**
	Separate a date-time into several components
	*/
	static parse(t: number): {days: number, hours: number, minutes: number, ms: number, seconds: number}
	
	/**
	Build a date-time from several components
	*/
	static make(o: {days: number, hours: number, minutes: number, ms: number, seconds: number}): number
	
	/**
	Retrieve Unix timestamp value from Date components. Takes same argument sequence as the Date constructor.
	*/
	static makeUtc(year: number, month: number, day: number, hour: number, min: number, sec: number): number
}

//# sourceMappingURL=DateTools.d.ts.map