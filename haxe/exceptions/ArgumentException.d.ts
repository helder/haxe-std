import {PosException} from "./PosException"
import {PosInfos} from "../PosInfos"
import {Exception} from "../Exception"

/**
An exception that is thrown when an invalid value provided for an argument of a function.
*/
export declare class ArgumentException extends PosException {
	constructor(argument: string, message?: null | string, previous?: null | Exception, pos?: null | PosInfos)
	
	/**
	An argument name.
	*/
	argument: string
}

//# sourceMappingURL=ArgumentException.d.ts.map