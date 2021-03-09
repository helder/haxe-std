import {IdentityValidationResult} from "./IdentityValidationResult"
import {IdentityProviderOptions} from "./IdentityProviderOptions"
import {IdentityAssertionResult} from "./IdentityAssertionResult"

export type IdentityProvider = {generateAssertion: (arg0: string, arg1: string, arg2: IdentityProviderOptions) => Promise<IdentityAssertionResult>, validateAssertion: (arg0: string, arg1: string) => Promise<IdentityValidationResult>}

//# sourceMappingURL=IdentityProvider.d.ts.map