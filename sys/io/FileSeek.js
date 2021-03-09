import {Register} from "../../genes/Register"

export const FileSeek = 
Register.global("$hxEnums")["sys.io.FileSeek"] = 
{
	__ename__: "sys.io.FileSeek",
	
	SeekBegin: {_hx_name: "SeekBegin", _hx_index: 0, __enum__: "sys.io.FileSeek"},
	SeekCur: {_hx_name: "SeekCur", _hx_index: 1, __enum__: "sys.io.FileSeek"},
	SeekEnd: {_hx_name: "SeekEnd", _hx_index: 2, __enum__: "sys.io.FileSeek"}
}
FileSeek.__constructs__ = [FileSeek.SeekBegin, FileSeek.SeekCur, FileSeek.SeekEnd]
FileSeek.__empty_constructs__ = [FileSeek.SeekBegin, FileSeek.SeekCur, FileSeek.SeekEnd]

//# sourceMappingURL=FileSeek.js.map