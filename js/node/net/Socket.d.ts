import {DnsLookupOptions, DnsLookupCallbackSingle} from "../Dns"

export type SocketOptionsBase = {allowHalfOpen?: null | boolean}

export type SocketOptions = {allowHalfOpen?: null | boolean, fd?: null | number, readable?: null | boolean, writable?: null | boolean}

export type SocketConnectOptionsTcp = {family?: null | number, host?: null | string, localAddress?: null | string, localPort?: null | number, lookup?: null | ((arg0: string, arg1: DnsLookupOptions, arg2: DnsLookupCallbackSingle) => void), port: number}

export type SocketConnectOptionsUnix = {path: string}

export type SocketAdress = {address: string, family: string, port: number}

//# sourceMappingURL=Socket.d.ts.map