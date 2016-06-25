/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Operators.startsWith = function zwigOperatorStartsWith(haystack, needle) {
    return checkStringBoundaries(haystack, needle, 'startsWith', startsWithPolyFill);
};

Operators.endsWith = function zwigOperatorEndsWith(haystack, needle) {
    return checkStringBoundaries(haystack, needle, 'endsWith', endsWithPolyFill);
};

function checkStringBoundaries(haystack, needle, nativeName, polyFill) {
    if (typeof haystack !== 'string' || typeof needle !== 'string') {
        return false;
    }

    // use the native function if available
    if (typeof haystack[nativeName] !== 'undefined') {
        return haystack[nativeName](needle);
    }

    return polyFill(haystack, needle);
}

function startsWithPolyFill(haystack, needle) {
    if (haystack.length < needle.length) {
        return false;
    }

    for (var i = 0; i < needle.length; i++) {
        if (haystack[i] !== needle[i]) {
            return false;
        }
    }

    return true;
}

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