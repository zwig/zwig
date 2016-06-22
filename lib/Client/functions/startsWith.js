/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.startsWith = function zwigFunctionStartsWith(haystack, needle) {
    if (typeof haystack != 'string' || typeof needle != 'string') {
        return false;
    }

    // use the native function if available
    if (typeof haystack.startsWith != 'undefined') {
        return haystack.startsWith(needle);
    }

    return startsWithPolyFill(haystack, needle);
};

function startsWithPolyFill(haystack, needle) {
    if (haystack.length < needle.length) {
        return false;
    }

    for (var i = 0; i < needle.length; i++) {
        if (haystack[i] != needle[i]) {
            return false;
        }
    }

    return true;
}