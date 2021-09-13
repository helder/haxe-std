import {PosException} from "./PosException"
import {PosInfos} from "../PosInfos"
import {Exception} from "../Exception"

/**
An exception that is thrown when requested function or operation does not have an implementation.
*/
export declare class NotImplementedException extends PosException {
	constructor(message?: string, previous?: null | Exception, pos?: null | PosInfos)
}

//# sourceMappingURL=NotImplementedException.d.ts.map