/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Operators.sub = function zwigOperatorSub(lhs, rhs) {
    return numberify(lhs) - numberify(rhs);
};