/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.concat = function zwigFunctionConcat(lhs, rhs) {
    return concatParamToString(lhs) + concatParamToString(rhs);
};

function concatParamToString(value) {
    return typeof value === 'object' && !isNull(value)? 'Array' : stringify(value);
}