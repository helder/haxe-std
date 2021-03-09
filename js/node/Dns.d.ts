
export type DnsLookupOptions = {all?: null | boolean, family?: null | number, hints?: null | number}

export type DnsResolvedAddressMX = {exchange: string, priority: number}

export type DnsResolvedAddressSRV = {name: string, port: number, priority: number, weight: number}

export type DnsResolvedAddressSOA = {expire: number, hostmaster: string, minttl: number, nsname: string, refresh: number, retry: number, serial: number}

export type DnsResolvedAddress = string | DnsResolvedAddressMX | DnsResolvedAddressSOA | DnsResolvedAddressSRV

export type DnsLookupCallbackSingle = ((err: DnsError, address: string, family: number) => void)

export type DnsLookupCallbackAll = ((err: DnsError, addresses: DnsLookupCallbackAllEntry[]) => void)

export type DnsLookupCallbackAllEntry = {address: string, family: number}

//# sourceMappingURL=Dns.d.ts.map