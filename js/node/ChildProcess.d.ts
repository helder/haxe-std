import {Buffer} from "buffer"

export type ChildProcessCommonOptions = {cwd?: null | string, env?: null | {[key: string]: string}, gid?: null | number, shell?: null | boolean | string, uid?: null | number}

export type ChildProcessSpawnOptionsBase = {cwd?: null | string, env?: null | {[key: string]: string}, gid?: null | number, shell?: null | boolean | string, stdio?: null | ChildProcessSpawnOptionsStdio, uid?: null | number}

export type ChildProcessSpawnOptions = {cwd?: null | string, detached?: null | boolean, env?: null | {[key: string]: string}, gid?: null | number, shell?: null | boolean | string, stdio?: null | ChildProcessSpawnOptionsStdio, uid?: null | number}

export type ChildProcessSpawnSyncOptions = {cwd?: null | string, encoding?: null | string, env?: null | {[key: string]: string}, gid?: null | number, input?: null | string | Buffer, killSignal?: null | string, maxBuffer?: null | number, shell?: null | boolean | string, stdio?: null | ChildProcessSpawnOptionsStdio, timeout?: null | number, uid?: null | number}

export type ChildProcessSpawnOptionsStdio = string | any[]

export type ChildProcessSpawnOptionsStdioFull = any[]

export type ChildProcessExecOptionsBase = {cwd?: null | string, encoding?: null | string, env?: null | {[key: string]: string}, gid?: null | number, killSignal?: null | string, maxBuffer?: null | number, shell?: null | boolean | string, timeout?: null | number, uid?: null | number}

export type ChildProcessExecOptions = {cwd?: null | string, encoding?: null | string, env?: null | {[key: string]: string}, gid?: null | number, killSignal?: null | string, maxBuffer?: null | number, shell?: null | boolean | string, timeout?: null | number, uid?: null | number}

export type ChildProcessExecFileOptions = {cwd?: null | string, encoding?: null | string, env?: null | {[key: string]: string}, gid?: null | number, killSignal?: null | string, maxBuffer?: null | number, shell?: null | boolean | string, timeout?: null | number, uid?: null | number}

export type ChildProcessForkOptions = {cwd?: null | string, env?: null | {[key: string]: string}, execArgv?: null | string[], execPath?: null | string, gid?: null | number, shell?: null | boolean | string, silent?: null | boolean, uid?: null | number}

export type ChildProcessExecCallback = ((error: null | Error, stdout: Buffer | string, stderr: Buffer | string) => void)

export type ChildProcessSpawnSyncResult = {error: Error, output: Buffer | string[], pid: number, signal: string, status: number, stderr: Buffer | string, stdout: Buffer | string}

//# sourceMappingURL=ChildProcess.d.ts.map