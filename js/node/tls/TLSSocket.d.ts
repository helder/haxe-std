import {Server} from "net"
import {Buffer} from "buffer"

export type TLSSocketOptions = {NPNProtocols?: null | string[] | Buffer, SNICallback?: null | ((servername: string, cb: ((arg0: Error) => SecureContext)) => void), isServer?: null | boolean, rejectUnauthorized?: null | boolean, requestCert?: null | boolean, requestOCSP?: null | boolean, secureContext?: null | SecureContext, server?: null | Server, session?: null | Buffer}

//# sourceMappingURL=TLSSocket.d.ts.map