import {ConstrainLongRange} from "./ConstrainLongRange"
import {ConstrainDoubleRange} from "./ConstrainDoubleRange"
import {ConstrainDOMStringParameters} from "./ConstrainDOMStringParameters"
import {ConstrainBooleanParameters} from "./ConstrainBooleanParameters"

export type MediaTrackConstraintSet = {autoGainControl?: null | boolean | ConstrainBooleanParameters, browserWindow?: null | number, channelCount?: null | number | ConstrainLongRange, deviceId?: null | string | string[] | ConstrainDOMStringParameters, echoCancellation?: null | boolean | ConstrainBooleanParameters, facingMode?: null | string | string[] | ConstrainDOMStringParameters, frameRate?: null | number | ConstrainDoubleRange, height?: null | number | ConstrainLongRange, mediaSource?: null | string, noiseSuppression?: null | boolean | ConstrainBooleanParameters, scrollWithPage?: null | boolean, viewportHeight?: null | number | ConstrainLongRange, viewportOffsetX?: null | number | ConstrainLongRange, viewportOffsetY?: null | number | ConstrainLongRange, viewportWidth?: null | number | ConstrainLongRange, width?: null | number | ConstrainLongRange}

//# sourceMappingURL=MediaTrackConstraintSet.d.ts.map