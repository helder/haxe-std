import {Xml} from "../../Xml"
import {Iterator} from "../../StdTypes"
import {EReg} from "../../EReg"

export declare namespace Filter {
	export type FReg = {_hx_index: 3, matcher: EReg, __enum__: "haxe.xml.Filter"}
	export const FReg: (matcher: EReg) => Filter
	export type FInt = {_hx_index: 0, __enum__: "haxe.xml.Filter"}
	export const FInt: FInt
	export type FEnum = {_hx_index: 2, values: string[], __enum__: "haxe.xml.Filter"}
	export const FEnum: (values: string[]) => Filter
	export type FBool = {_hx_index: 1, __enum__: "haxe.xml.Filter"}
	export const FBool: FBool
}

export declare type Filter = 
	| Filter.FReg
	| Filter.FInt
	| Filter.FEnum
	| Filter.FBool

export declare namespace Attrib {
	export type Att = {_hx_index: 0, name: string, filter: null | Filter, defvalue: null | string, __enum__: "haxe.xml.Attrib"}
	export const Att: (name: string, filter: null | Filter, defvalue: null | string) => Attrib
}

export declare type Attrib = 
	| Attrib.Att

export declare namespace Rule {
	export type ROptional = {_hx_index: 5, rule: Rule, __enum__: "haxe.xml.Rule"}
	export const ROptional: (rule: Rule) => Rule
	export type RNode = {_hx_index: 0, name: string, attribs: null | Attrib[], childs: null | Rule, __enum__: "haxe.xml.Rule"}
	export const RNode: (name: string, attribs: null | Attrib[], childs: null | Rule) => Rule
	export type RMulti = {_hx_index: 2, rule: Rule, atLeastOne: null | boolean, __enum__: "haxe.xml.Rule"}
	export const RMulti: (rule: Rule, atLeastOne: null | boolean) => Rule
	export type RList = {_hx_index: 3, rules: Rule[], ordered: null | boolean, __enum__: "haxe.xml.Rule"}
	export const RList: (rules: Rule[], ordered: null | boolean) => Rule
	export type RData = {_hx_index: 1, filter: null | Filter, __enum__: "haxe.xml.Rule"}
	export const RData: (filter: null | Filter) => Rule
	export type RChoice = {_hx_index: 4, choices: Rule[], __enum__: "haxe.xml.Rule"}
	export const RChoice: (choices: Rule[]) => Rule
}

export declare type Rule = 
	| Rule.ROptional
	| Rule.RNode
	| Rule.RMulti
	| Rule.RList
	| Rule.RData
	| Rule.RChoice

export declare namespace CheckResult {
	export type CMissingAttrib = {_hx_index: 6, att: string, x: Xml, __enum__: "haxe.xml._Check.CheckResult"}
	export const CMissingAttrib: (att: string, x: Xml) => CheckResult
	export type CMissing = {_hx_index: 1, r: Rule, __enum__: "haxe.xml._Check.CheckResult"}
	export const CMissing: (r: Rule) => CheckResult
	export type CMatch = {_hx_index: 0, __enum__: "haxe.xml._Check.CheckResult"}
	export const CMatch: CMatch
	export type CInvalidData = {_hx_index: 8, x: Xml, f: Filter, __enum__: "haxe.xml._Check.CheckResult"}
	export const CInvalidData: (x: Xml, f: Filter) => CheckResult
	export type CInvalidAttrib = {_hx_index: 7, att: string, x: Xml, f: Filter, __enum__: "haxe.xml._Check.CheckResult"}
	export const CInvalidAttrib: (att: string, x: Xml, f: Filter) => CheckResult
	export type CInElement = {_hx_index: 9, x: Xml, r: CheckResult, __enum__: "haxe.xml._Check.CheckResult"}
	export const CInElement: (x: Xml, r: CheckResult) => CheckResult
	export type CExtraAttrib = {_hx_index: 5, att: string, x: Xml, __enum__: "haxe.xml._Check.CheckResult"}
	export const CExtraAttrib: (att: string, x: Xml) => CheckResult
	export type CExtra = {_hx_index: 2, x: Xml, __enum__: "haxe.xml._Check.CheckResult"}
	export const CExtra: (x: Xml) => CheckResult
	export type CElementExpected = {_hx_index: 3, name: string, x: Xml, __enum__: "haxe.xml._Check.CheckResult"}
	export const CElementExpected: (name: string, x: Xml) => CheckResult
	export type CDataExpected = {_hx_index: 4, x: Xml, __enum__: "haxe.xml._Check.CheckResult"}
	export const CDataExpected: (x: Xml) => CheckResult
}

export declare type CheckResult = 
	| CheckResult.CMissingAttrib
	| CheckResult.CMissing
	| CheckResult.CMatch
	| CheckResult.CInvalidData
	| CheckResult.CInvalidAttrib
	| CheckResult.CInElement
	| CheckResult.CExtraAttrib
	| CheckResult.CExtra
	| CheckResult.CElementExpected
	| CheckResult.CDataExpected

export declare class Check {
	static checkNode(x: Xml, r: Rule): void
	static checkDocument(x: Xml, r: Rule): void
}

//# sourceMappingURL=Check.d.ts.map