import {SocketConnectOptionsTcp} from "./net/Socket"
import {Agent} from "http"

export type HttpCreateServerOptions = {IncomingMessage?: null | any, ServerResponse?: null | any}

export type HttpRequestOptions = {agent?: null | Agent | boolean, auth?: null | string, createConnection?: null | ((options: SocketConnectOptionsTcp, callabck?: ((err: Error, stream: IDuplex) => void)) => IDuplex), defaultPort?: null | number, family?: null | number, headers?: null | {[key: string]: string | string[]}, host?: null | string, hostname?: null | string, localAddress?: null | string, method?: null | string, path?: null | string, port?: null | number, protocol?: null | string, setHost?: null | boolean, socketPath?: null | string, timeout?: null | number}

//# sourceMappingURL=Http.d.ts.map