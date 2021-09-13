import {Xml} from "../../Xml"
import {StringBuf} from "../../StringBuf"

/**
This class provides utility methods to convert Xml instances to
String representation.
*/
export declare class Printer {
	protected constructor(pretty: boolean)
	protected output: StringBuf
	protected pretty: boolean
	protected writeNode(value: Xml, tabs: string): void
	protected write(input: string): void
	protected newline(): void
	protected hasChildren(value: Xml): boolean
	
	/**
	Convert `Xml` to string representation.
	
	Set `pretty` to `true` to prettify the result.
	*/
	static print(xml: Xml, pretty?: null | boolean): string
}

//# sourceMappingURL=Printer.d.ts.map