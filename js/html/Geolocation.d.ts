import {PositionOptions} from "./PositionOptions"
import {Position} from "./Position"

export type Geolocation = {clearWatch: (watchId: number) => void, getCurrentPosition: (successCallback: ((arg0: Position) => void), errorCallback?: ((arg0: PositionError) => void), options?: PositionOptions) => void, watchPosition: (successCallback: ((arg0: Position) => void), errorCallback?: ((arg0: PositionError) => void), options?: PositionOptions) => number}

//# sourceMappingURL=Geolocation.d.ts.map