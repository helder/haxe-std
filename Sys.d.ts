import {Output} from "./haxe/io/Output"
import {Input} from "./haxe/io/Input"
import {Encoding} from "./haxe/io/Encoding"
import {Bytes} from "./haxe/io/Bytes"
import {Map} from "./Map"

/**
This class provides access to various base functions of system platforms.
Look in the `sys` package for more system APIs.
*/
export declare class Sys {
	
	/**
	Prints any value to the standard output.
	*/
	static print(v: any): void
	
	/**
	Prints any value to the standard output, followed by a newline.
	On Windows, this function outputs a CRLF newline.
	LF newlines are printed on all other platforms.
	*/
	static println(v: any): void
	
	/**
	Returns all the arguments that were passed in the command line.
	This does not include the interpreter or the name of the program file.
	
	(java)(eval) On Windows, non-ASCII Unicode arguments will not work correctly.
	
	(cs) Non-ASCII Unicode arguments will not work correctly.
	*/
	static args(): string[]
	
	/**
	Returns the value of the given environment variable, or `null` if it
	doesn't exist.
	*/
	static getEnv(s: string): string
	
	/**
	Sets the value of the given environment variable.
	
	(java) This functionality is not available on Java; calling this function will throw.
	*/
	static putEnv(s: string, v: string): void
	
	/**
	Returns all environment variables.
	*/
	static environment(): Map<string, string>
	
	/**
	Changes the current time locale, which will affect `DateTools.format` date formating.
	Returns `true` if the locale was successfully changed.
	*/
	static setTimeLocale(loc: string): boolean
	
	/**
	Gets the current working directory (usually the one in which the program was started).
	*/
	static getCwd(): string
	
	/**
	Changes the current working directory.
	
	(java) This functionality is not available on Java; calling this function will throw.
	*/
	static setCwd(s: string): void
	
	/**
	Returns the type of the current system. Possible values are:
	- `"Windows"`
	- `"Linux"`
	- `"BSD"`
	- `"Mac"`
	*/
	static systemName(): string
	
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
	static command(cmd: string, args?: null | string[]): number
	
	/**
	Exits the current process with the given exit code.
	
	(macro)(eval) Being invoked in a macro or eval context (e.g. with `-x` or `--run`) immediately terminates
	the compilation process, which also prevents the execution of any `--next` sections of compilation arguments.
	*/
	static exit(code: number): void
	
	/**
	Gives the most precise timestamp value available (in seconds).
	*/
	static time(): number
	
	/**
	Gives the most precise timestamp value available (in seconds),
	but only accounts for the actual time spent running on the CPU for the current thread/process.
	*/
	static cpuTime(): number
	
	/**
	Returns the path to the current executable that we are running.
	*/
	static executablePath(): string
	
	/**
	Returns the absolute path to the current program file that we are running.
	Concretely, for an executable binary, it returns the path to the binary.
	For a script (e.g. a PHP file), it returns the path to the script.
	*/
	static programPath(): string
	
	/**
	Reads a single input character from the standard input and returns it.
	Setting `echo` to `true` will also display the character on the output.
	*/
	static getChar(echo: boolean): number
	
	/**
	Suspends execution for the given length of time (in seconds).
	*/
	static sleep(seconds: number): void
	
	/**
	Returns the standard input of the process, from which user input can be read.
	Usually it will block until the user sends a full input line.
	See `getChar` for an alternative.
	*/
	static stdin(): Input
	
	/**
	Returns the standard output of the process, to which program output can be written.
	*/
	static stdout(): Output
	
	/**
	Returns the standard error of the process, to which program errors can be written.
	*/
	static stderr(): Output
}

export declare class FileOutput extends Output {
	constructor(fd: number)
	writeByte(c: number): void
	writeBytes(s: Bytes, pos: number, len: number): number
	writeString(s: string, encoding?: null | Encoding): void
	flush(): void
	close(): void
}

export declare class FileInput extends Input {
	constructor(fd: number)
	readByte(): number
	readBytes(s: Bytes, pos: number, len: number): number
	close(): void
}

//# sourceMappingURL=Sys.d.ts.map