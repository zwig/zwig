/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Operators.floordiv = function zwigOperatorFloorDiv(lhs, rhs) {
    return Math.floor(Operators.div(lhs, rhs));
};