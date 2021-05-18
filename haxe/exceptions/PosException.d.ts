import {PosInfos} from "../PosInfos"
import {Exception} from "../Exception"

/**
An exception that carry position information of a place where it was created.
*/
export declare class PosException extends Exception {
	constructor(message: string, previous?: null | Exception, pos?: null | PosInfos)
	
	/**
	Position where this exception was created.
	*/
	posInfos: PosInfos
	
	/**
	Returns exception message.
	*/
	toString(): string
}

//# sourceMappingURL=PosException.d.ts.map