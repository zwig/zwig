/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Operators.mod = function zwigOperatorMod(lhs, rhs) {
    return (isNaN(lhs) ? 0 : Math.floor(lhs)) % (isNaN(rhs) ? 0 : Math.floor(rhs));
};