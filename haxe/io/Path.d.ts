
/**
This class provides a convenient way of working with paths. It supports the
common path formats:

- `directory1/directory2/filename.extension`
- `directory1\directory2\filename.extension`
*/
export declare class Path {
	constructor(path: string)
	
	/**
	The directory.
	
	This is the leading part of the path that is not part of the file name
	and the extension.
	
	Does not end with a `/` or `\` separator.
	
	If the path has no directory, the value is `null`.
	*/
	dir: null | string
	
	/**
	The file name.
	
	This is the part of the part between the directory and the extension.
	
	If there is no file name, e.g. for `".htaccess"` or `"/dir/"`, the value
	is the empty String `""`.
	*/
	file: string
	
	/**
	The file extension.
	
	It is separated from the file name by a dot. This dot is not part of
	the extension.
	
	If the path has no extension, the value is `null`.
	*/
	ext: null | string
	
	/**
	`true` if the last directory separator is a backslash, `false` otherwise.
	*/
	backslash: boolean
	
	/**
	Returns a String representation of `this` path.
	
	If `this.backslash` is `true`, backslash is used as directory separator,
	otherwise slash is used. This only affects the separator between
	`this.dir` and `this.file`.
	
	If `this.directory` or `this.extension` is `null`, their representation
	is the empty String `""`.
	*/
	toString(): string
	
	/**
	Returns the String representation of `path` without the file extension.
	
	If `path` is `null`, the result is unspecified.
	*/
	static withoutExtension(path: string): string
	
	/**
	Returns the String representation of `path` without the directory.
	
	If `path` is `null`, the result is unspecified.
	*/
	static withoutDirectory(path: string): string
	
	/**
	Returns the directory of `path`.
	
	If the directory is `null`, the empty String `""` is returned.
	
	If `path` is `null`, the result is unspecified.
	*/
	static directory(path: string): string
	
	/**
	Returns the extension of `path`.
	
	If `path` has no extension, the empty String `""` is returned.
	
	If `path` is `null`, the result is unspecified.
	*/
	static extension(path: string): string
	
	/**
	Returns a String representation of `path` where the extension is `ext`.
	
	If `path` has no extension, `ext` is added as extension.
	
	If `path` or `ext` are `null`, the result is unspecified.
	*/
	static withExtension(path: string, ext: null | string): string
	
	/**
	Joins all paths in `paths` together.
	
	If `paths` is empty, the empty String `""` is returned. Otherwise the
	paths are joined with a slash between them.
	
	If `paths` is `null`, the result is unspecified.
	*/
	static join(paths: string[]): string
	
	/**
	Normalize a given `path` (e.g. turn `'/usr/local/../lib'` into `'/usr/lib'`).
	
	Also replaces backslashes `\` with slashes `/` and afterwards turns
	multiple slashes into a single one.
	
	If `path` is `null`, the result is unspecified.
	*/
	static normalize(path: string): string
	
	/**
	Adds a trailing slash to `path`, if it does not have one already.
	
	If the last slash in `path` is a backslash, a backslash is appended to
	`path`.
	
	If the last slash in `path` is a slash, or if no slash is found, a slash
	is appended to `path`. In particular, this applies to the empty String
	`""`.
	
	If `path` is `null`, the result is unspecified.
	*/
	static addTrailingSlash(path: string): string
	
	/**
	Removes trailing slashes from `path`.
	
	If `path` does not end with a `/` or `\`, `path` is returned unchanged.
	
	Otherwise the substring of `path` excluding the trailing slashes or
	backslashes is returned.
	
	If `path` is `null`, the result is unspecified.
	*/
	static removeTrailingSlashes(path: string): string
	
	/**
	Returns `true` if the path is an absolute path, and `false` otherwise.
	*/
	static isAbsolute(path: string): boolean
	protected static unescape(path: string): string
	protected static escape(path: string, allowSlashes?: boolean): string
}

//# sourceMappingURL=Path.d.ts.map