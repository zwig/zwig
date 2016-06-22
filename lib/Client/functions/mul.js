/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.mul = function zwigFunctionMul(lhs, rhs) {
    return (isNaN(lhs) ? 0 : Number(lhs)) * (isNaN(rhs) ? 0 : Number(rhs));
};