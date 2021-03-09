import {HaxeError} from "./js/Boot.js"
import {Register} from "./genes/Register.js"
import {StringTools} from "./StringTools.js"
import {Std} from "./Std.js"
import {HxOverrides} from "./HxOverrides.js"

/**
The DateTools class contains some extra functionalities for handling `Date`
instances and timestamps.

In the context of Haxe dates, a timestamp is defined as the number of
milliseconds elapsed since 1st January 1970.
*/
export const DateTools = Register.global("$hxClasses")["DateTools"] = 
class DateTools {
	static __format_get(d, e) {
		switch (e) {
			case "%":
				return "%";
				break
			case "A":
				return DateTools.DAY_NAMES[d.getDay()];
				break
			case "B":
				return DateTools.MONTH_NAMES[d.getMonth()];
				break
			case "C":
				return StringTools.lpad(Std.string(d.getFullYear() / 100 | 0), "0", 2);
				break
			case "D":
				return DateTools.__format(d, "%m/%d/%y");
				break
			case "F":
				return DateTools.__format(d, "%Y-%m-%d");
				break
			case "I":case "l":
				var hour = d.getHours() % 12;
				return StringTools.lpad(Std.string((hour == 0) ? 12 : hour), (e == "I") ? "0" : " ", 2);
				break
			case "M":
				return StringTools.lpad(Std.string(d.getMinutes()), "0", 2);
				break
			case "R":
				return DateTools.__format(d, "%H:%M");
				break
			case "S":
				return StringTools.lpad(Std.string(d.getSeconds()), "0", 2);
				break
			case "T":
				return DateTools.__format(d, "%H:%M:%S");
				break
			case "Y":
				return Std.string(d.getFullYear());
				break
			case "a":
				return DateTools.DAY_SHORT_NAMES[d.getDay()];
				break
			case "b":case "h":
				return DateTools.MONTH_SHORT_NAMES[d.getMonth()];
				break
			case "d":
				return StringTools.lpad(Std.string(d.getDate()), "0", 2);
				break
			case "e":
				return Std.string(d.getDate());
				break
			case "H":case "k":
				return StringTools.lpad(Std.string(d.getHours()), (e == "H") ? "0" : " ", 2);
				break
			case "m":
				return StringTools.lpad(Std.string(d.getMonth() + 1), "0", 2);
				break
			case "n":
				return "\n";
				break
			case "p":
				if (d.getHours() > 11) {
					return "PM";
				} else {
					return "AM";
				};
				break
			case "r":
				return DateTools.__format(d, "%I:%M:%S %p");
				break
			case "s":
				return Std.string(d.getTime() / 1000 | 0);
				break
			case "t":
				return "\t";
				break
			case "u":
				var t = d.getDay();
				if (t == 0) {
					return "7";
				} else if (t == null) {
					return "null";
				} else {
					return "" + t;
				};
				break
			case "w":
				return Std.string(d.getDay());
				break
			case "y":
				return StringTools.lpad(Std.string(d.getFullYear() % 100), "0", 2);
				break
			default:
			throw new HaxeError("Date.format %" + e + "- not implemented yet.");
			
		};
	}
	static __format(d, f) {
		var r_b = "";
		var p = 0;
		while (true) {
			var np = f.indexOf("%", p);
			if (np < 0) {
				break;
			};
			var len = np - p;
			r_b += (len == null) ? HxOverrides.substr(f, p, null) : HxOverrides.substr(f, p, len);
			r_b += Std.string(DateTools.__format_get(d, HxOverrides.substr(f, np + 1, 1)));
			p = np + 2;
		};
		var len1 = f.length - p;
		r_b += (len1 == null) ? HxOverrides.substr(f, p, null) : HxOverrides.substr(f, p, len1);
		return r_b;
	}
	
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
	static format(d, f) {
		return DateTools.__format(d, f);
	}
	
	/**
	Returns the result of adding timestamp `t` to Date `d`.
	
	This is a convenience function for calling
	`Date.fromTime(d.getTime() + t)`.
	*/
	static delta(d, t) {
		return new Date(d.getTime() + t);
	}
	
	/**
	Returns the number of days in the month of Date `d`.
	
	This method handles leap years.
	*/
	static getMonthDays(d) {
		var month = d.getMonth();
		var year = d.getFullYear();
		if (month != 1) {
			return DateTools.DAYS_OF_MONTH[month];
		};
		var isB = year % 4 == 0 && year % 100 != 0 || year % 400 == 0;
		if (isB) {
			return 29;
		} else {
			return 28;
		};
	}
	
	/**
	Converts a number of seconds to a timestamp.
	*/
	static seconds(n) {
		return n * 1000.0;
	}
	
	/**
	Converts a number of minutes to a timestamp.
	*/
	static minutes(n) {
		return n * 60.0 * 1000.0;
	}
	
	/**
	Converts a number of hours to a timestamp.
	*/
	static hours(n) {
		return n * 60.0 * 60.0 * 1000.0;
	}
	
	/**
	Converts a number of days to a timestamp.
	*/
	static days(n) {
		return n * 24.0 * 60.0 * 60.0 * 1000.0;
	}
	
	/**
	Separate a date-time into several components
	*/
	static parse(t) {
		var s = t / 1000;
		var m = s / 60;
		var h = m / 60;
		return {"ms": t % 1000, "seconds": s % 60 | 0, "minutes": m % 60 | 0, "hours": h % 24 | 0, "days": h / 24 | 0};
	}
	
	/**
	Build a date-time from several components
	*/
	static make(o) {
		return o.ms + 1000.0 * (o.seconds + 60.0 * (o.minutes + 60.0 * (o.hours + 24.0 * o.days)));
	}
	
	/**
	Retrieve Unix timestamp value from Date components. Takes same argument sequence as the Date constructor.
	*/
	static makeUtc(year, month, day, hour, min, sec) {
		return Date.UTC(year, month, day, hour, min, sec);
	}
	static get __name__() {
		return "DateTools"
	}
	get __class__() {
		return DateTools
	}
}


DateTools.DAY_SHORT_NAMES = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
DateTools.DAY_NAMES = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
DateTools.MONTH_SHORT_NAMES = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
DateTools.MONTH_NAMES = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
DateTools.DAYS_OF_MONTH = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
//# sourceMappingURL=DateTools.js.map