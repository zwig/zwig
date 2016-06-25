/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.endsWith = function zwigFunctionEndsWith(lhs, rhs) {
    if (typeof lhs !== 'string' || typeof rhs !== 'string') {
        return false;
    }

    // use the native function if available
    if (typeof lhs.endsWith !== 'undefined') {
        return lhs.endsWith(rhs);
    }

    return endsWithPolyFill(lhs, rhs);
};

function endsWithPolyFill(haystack, needle) {
    if (haystack.length < needle.length) {
        return false;
    }

    for (var i = 1; i <= needle.length; i++) {
        if (haystack[haystack.length - i] !== needle[needle.length - i]) {
            return false;
        }
    }

    return true;
}