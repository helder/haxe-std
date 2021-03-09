import {Socket} from "net"
import {Buffer} from "buffer"

export type TlsOptionsBase = {NPNProtocols?: null | string[] | Buffer, rejectUnauthorized?: null | boolean}

export type TlsServerOptionsBase = {NPNProtocols?: null | string[] | Buffer, SNICallback?: null | ((servername: string, cb: ((arg0: Error) => SecureContext)) => void), rejectUnauthorized?: null | boolean, requestCert?: null | boolean}

export type TlsClientOptionsBase = {NPNProtocols?: null | string[] | Buffer, rejectUnauthorized?: null | boolean, requestOCSP?: null | boolean, session?: null | Buffer}

export type TlsCreateServerOptions = {NPNProtocols?: null | string[] | Buffer, SNICallback?: null | ((servername: string, cb: ((arg0: Error) => SecureContext)) => void), ca?: null | string | Buffer[], cert?: null | string | Buffer, ciphers?: null | string, crl?: null | string | string[], dhparam?: null | string | Buffer, ecdhCurve?: null | string, handshakeTimeout?: null | number, honorCipherOrder?: null | boolean, key?: null | string | Buffer, passphrase?: null | string, pfx?: null | string | Buffer, rejectUnauthorized?: null | boolean, requestCert?: null | boolean, secureProtocol?: null | string, sessionIdContext?: null | string, sessionTimeout?: null | number, ticketKeys?: null | Buffer}

export type TlsConnectOptions = {NPNProtocols?: null | string[] | Buffer, ca?: null | string | Buffer[], cert?: null | string | Buffer, checkServerIdentity?: null | ((arg0: string, arg1: {}) => any), ciphers?: null | string, crl?: null | string | string[], dhparam?: null | string | Buffer, ecdhCurve?: null | string, honorCipherOrder?: null | boolean, host?: null | string, key?: null | string | Buffer, passphrase?: null | string, path?: null | string, pfx?: null | string | Buffer, port?: null | number, rejectUnauthorized?: null | boolean, requestOCSP?: null | boolean, secureProtocol?: null | string, servername?: null | string, session?: null | Buffer, sessionIdContext?: null | string, socket?: null | Socket}

//# sourceMappingURL=Tls.d.ts.map