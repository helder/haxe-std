import {Buffer} from "buffer"

export type FsPath = string | Buffer

export type FsWatchFileOptions = {interval?: null | number, persistent?: null | boolean}

export type FsMode = number | string

export type FsWriteFileOptions = {encoding?: null | string, flag?: null | string, mode?: any}

export type FsCreateReadStreamOptions = {autoClose?: null | boolean, encoding?: null | string, end?: null | number, fd?: null | number, flags?: null | string, mode?: any, start?: null | number}

export type FsCreateWriteStreamOptions = {encoding?: null | string, flags?: null | string, mode?: any, start?: null | number}

export type FsConstants = {F_OK: number, O_APPEND: number, O_CREAT: number, O_DIRECT: number, O_DIRECTORY: number, O_EXCL: number, O_NOATIME: number, O_NOCTTY: number, O_NOFOLLOW: number, O_NONBLOCK: number, O_RDONLY: number, O_RDWR: number, O_SYMLINK: number, O_SYNC: number, O_TRUNC: number, O_WRONLY: number, R_OK: number, S_IFBLK: number, S_IFCHR: number, S_IFDIR: number, S_IFIFO: number, S_IFLNK: number, S_IFMT: number, S_IFREG: number, S_IFSOCK: number, S_IRGRP: number, S_IROTH: number, S_IRUSR: number, S_IRWXG: number, S_IRWXO: number, S_IRWXU: number, S_IWGRP: number, S_IWOTH: number, S_IWUSR: number, S_IXGRP: number, S_IXOTH: number, S_IXUSR: number, W_OK: number, X_OK: number}

//# sourceMappingURL=Fs.d.ts.map