/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Operators.in = function zwigOperatorIn(needle, haystack) {
    if (typeof haystack === 'undefined') {
        return false;
    }

    if (typeof haystack === 'string') {
        return inString(haystack, needle);
    }

    if (typeof haystack.length === 'undefined') {
        return inObject(haystack, needle);
    }

    return inList(haystack, needle);
};

function inString(haystack, needle) {
    return haystack.indexOf(needle) !== -1;
}

function inObject(haystack, needle) {
    for (var key in haystack) {
        if (haystack.hasOwnProperty(key)) {
            if (haystack[key] == needle) { // eslint-disable-line
                return true;
            }
        }
    }

    return false;
}

function inList(haystack, needle) {
    for (var i = 0; i < haystack.length; i++) {
        if (haystack[i] == needle) { // eslint-disable-line
            return true;
        }
    }

    return false;
}