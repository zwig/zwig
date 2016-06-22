/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.matches = function zwigFunctionMatches(value, expr) {
    if (typeof value == 'object') {
        return false;
    }

    var segments = expr.match(/^\/(.+)\/(.?)$/);
    var regex = segments ? segments[1] : expr;
    var option = segments ? segments[2] : '';

    value = stringify(value);

    return value.match(new RegExp(regex, option));
};