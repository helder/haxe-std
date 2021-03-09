import {Output} from "./haxe/io/Output.js"
import {Input} from "./haxe/io/Input.js"
import {Error} from "./haxe/io/Error.js"
import {Eof} from "./haxe/io/Eof.js"
import {StringMap} from "./haxe/ds/StringMap.js"
import {NativeStackTrace} from "./haxe/NativeStackTrace.js"
import {Exception} from "./haxe/Exception.js"
import {Register} from "./genes/Register.js"
import * as Fs from "fs"
import * as ChildProcess from "child_process"
import {Buffer} from "buffer"
import {Std} from "./Std.js"
import {Reflect} from "./Reflect.js"

/**
This class provides access to various base functions of system platforms.
Look in the `sys` package for more system APIs.
*/
export const Sys = Register.global("$hxClasses")["Sys"] = 
class Sys {
	
	/**
	Prints any value to the standard output.
	*/
	static print(v) {
		process.stdout.write(Std.string(v));
	}
	
	/**
	Prints any value to the standard output, followed by a newline.
	On Windows, this function outputs a CRLF newline.
	LF newlines are printed on all other platforms.
	*/
	static println(v) {
		process.stdout.write(Std.string(v));
		process.stdout.write("\n");
	}
	
	/**
	Returns all the arguments that were passed in the command line.
	This does not include the interpreter or the name of the program file.
	
	(java)(eval) On Windows, non-ASCII Unicode arguments will not work correctly.
	
	(cs) Non-ASCII Unicode arguments will not work correctly.
	*/
	static args() {
		return process.argv.slice(2);
	}
	
	/**
	Returns the value of the given environment variable, or `null` if it
	doesn't exist.
	*/
	static getEnv(s) {
		return process.env[s];
	}
	
	/**
	Sets the value of the given environment variable.
	
	(java) This functionality is not available on Java; calling this function will throw.
	*/
	static putEnv(s, v) {
		process.env[s] = v;
	}
	
	/**
	Returns all environment variables.
	*/
	static environment() {
		let m = new StringMap();
		let _g = 0;
		let _g1 = Reflect.fields(process.env);
		while (_g < _g1.length) {
			let key = _g1[_g];
			++_g;
			let v = process.env[key];
			m.inst.set(key, v);
		};
		return m;
	}
	
	/**
	Changes the current time locale, which will affect `DateTools.format` date formating.
	Returns `true` if the locale was successfully changed.
	*/
	static setTimeLocale(loc) {
		return false;
	}
	
	/**
	Gets the current working directory (usually the one in which the program was started).
	*/
	static getCwd() {
		return process.cwd();
	}
	
	/**
	Changes the current working directory.
	
	(java) This functionality is not available on Java; calling this function will throw.
	*/
	static setCwd(s) {
		process.chdir(s);
	}
	
	/**
	Returns the type of the current system. Possible values are:
	- `"Windows"`
	- `"Linux"`
	- `"BSD"`
	- `"Mac"`
	*/
	static systemName() {
		let _g = process.platform;
		switch (_g) {
			case "darwin":
				return "Mac";
				break
			case "freebsd":
				return "BSD";
				break
			case "linux":
				return "Linux";
				break
			case "win32":
				return "Windows";
				break
			default:
			let other = _g;
			return other;
			
		};
	}
	
	/**
	Runs the given command. The command output will be printed to the same output as the current process.
	The current process will block until the command terminates.
	The return value is the exit code of the command (usually `0` indicates no error).
	
	Command arguments can be passed in two ways:
	
	1. Using `args` to pass command arguments. Each argument will be automatically quoted and shell meta-characters will be escaped if needed.
	`cmd` should be an executable name that can be located in the `PATH` environment variable, or a full path to an executable.
	
	2. When `args` is not given or is `null`, command arguments can be appended to `cmd`. No automatic quoting/escaping will be performed. `cmd` should be formatted exactly as it would be when typed at the command line.
	It can run executables, as well as shell commands that are not executables (e.g. on Windows: `dir`, `cd`, `echo` etc).
	
	Use the `sys.io.Process` API for more complex tasks, such as background processes, or providing input to the command.
	*/
	static command(cmd, args = null) {
		if (args == null) {
			return ChildProcess.spawnSync(cmd, {"shell": true, "stdio": "inherit"}).status;
		} else {
			return ChildProcess.spawnSync(cmd, args, {"stdio": "inherit"}).status;
		};
	}
	
	/**
	Exits the current process with the given exit code.
	
	(macro)(eval) Being invoked in a macro or eval context (e.g. with `-x` or `--run`) immediately terminates
	the compilation process, which also prevents the execution of any `--next` sections of compilation arguments.
	*/
	static exit(code) {
		process.exit(code);
	}
	
	/**
	Gives the most precise timestamp value available (in seconds).
	*/
	static time() {
		return Date.now() / 1000;
	}
	
	/**
	Gives the most precise timestamp value available (in seconds),
	but only accounts for the actual time spent running on the CPU for the current thread/process.
	*/
	static cpuTime() {
		return process.uptime();
	}
	
	/**
	Returns the path to the current executable that we are running.
	*/
	static executablePath() {
		return process.argv[0];
	}
	
	/**
	Returns the absolute path to the current program file that we are running.
	Concretely, for an executable binary, it returns the path to the binary.
	For a script (e.g. a PHP file), it returns the path to the script.
	*/
	static programPath() {
		return __filename;
	}
	
	/**
	Reads a single input character from the standard input and returns it.
	Setting `echo` to `true` will also display the character on the output.
	*/
	static getChar(echo) {
		throw Exception.thrown("Sys.getChar is currently not implemented on node.js");
	}
	
	/**
	Suspends execution for the given length of time (in seconds).
	*/
	static sleep(seconds) {
		let end = Date.now() + seconds * 1000;
		while (Date.now() <= end) {
		};
	}
	
	/**
	Returns the standard input of the process, from which user input can be read.
	Usually it will block until the user sends a full input line.
	See `getChar` for an alternative.
	*/
	static stdin() {
		return new FileInput(0);
	}
	
	/**
	Returns the standard output of the process, to which program output can be written.
	*/
	static stdout() {
		return new FileOutput(1);
	}
	
	/**
	Returns the standard error of the process, to which program errors can be written.
	*/
	static stderr() {
		return new FileOutput(2);
	}
	static get __name__() {
		return "Sys"
	}
	get __class__() {
		return Sys
	}
}


export const FileOutput = Register.global("$hxClasses")["_Sys.FileOutput"] = 
class FileOutput extends Register.inherits(Output) {
	new(fd) {
		this.fd = fd;
	}
	writeByte(c) {
		Fs.writeSync(this.fd, String.fromCodePoint(c));
	}
	writeBytes(s, pos, len) {
		let data = s.b;
		return Fs.writeSync(this.fd, Buffer.from(data.buffer, data.byteOffset, s.length), pos, len);
	}
	writeString(s, encoding = null) {
		Fs.writeSync(this.fd, s);
	}
	flush() {
		Fs.fsyncSync(this.fd);
	}
	close() {
		Fs.closeSync(this.fd);
	}
	static get __name__() {
		return "_Sys.FileOutput"
	}
	static get __super__() {
		return Output
	}
	get __class__() {
		return FileOutput
	}
}


export const FileInput = Register.global("$hxClasses")["_Sys.FileInput"] = 
class FileInput extends Register.inherits(Input) {
	new(fd) {
		this.fd = fd;
	}
	readByte() {
		let buf = Buffer.alloc(1);
		try {
			Fs.readSync(this.fd, buf, 0, 1, null);
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			let e = Exception.caught(_g).unwrap();
			if (e.code == "EOF") {
				throw Exception.thrown(new Eof());
			} else {
				throw Exception.thrown(Error.Custom(e));
			};
		};
		return buf[0];
	}
	readBytes(s, pos, len) {
		let data = s.b;
		let buf = Buffer.from(data.buffer, data.byteOffset, s.length);
		try {
			return Fs.readSync(this.fd, buf, pos, len, null);
		}catch (_g) {
			NativeStackTrace.lastError = _g;
			let e = Exception.caught(_g).unwrap();
			if (e.code == "EOF") {
				throw Exception.thrown(new Eof());
			} else {
				throw Exception.thrown(Error.Custom(e));
			};
		};
	}
	close() {
		Fs.closeSync(this.fd);
	}
	static get __name__() {
		return "_Sys.FileInput"
	}
	static get __super__() {
		return Input
	}
	get __class__() {
		return FileInput
	}
}


//# sourceMappingURL=Sys.js.map