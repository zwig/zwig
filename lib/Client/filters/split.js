/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.split = function zwigFilterSplit(value, separator, limit) {
    if (typeof separator == 'undefined') {
        separator = '';
    }

    // Weird PHP peculiarity #1
    if (isNull(value)) {
        return [''];
    }

    // Weird PHP peculiarity #2
    if (value === '' || limit === 0) {
        return [value];
    }

    value = stringify(value);

    // We can use the vanilla split method when no limit is specified.
    if (typeof limit == 'undefined') {
        return value.split(separator);
    }

    // The PHP explode function has a lot of exceptions.
    // Like the handling when using an empty separator.
    // See http://php.net/explode
    if (separator === '') {
        return splitIntoEqualSegments(value, limit);
    }

    if (limit > 0) {
        return splitWithPositiveLimit(value, separator, limit);
    } else {
        return splitWithNegativeLimit(value, separator, limit);
    }
};

function splitWithPositiveLimit(value, separator, limit) {
    var segments = value.split(separator, limit);
    var length = 0;

    for (var i = 0; i < segments.length; i++) {
        length += segments[i].length;
    }

    length += (segments.length - 1) * separator.length;

    if (length < value.length) {
        segments[segments.length - 1] += value.substr(length, value.length - length);
    }

    return segments;
}

function splitWithNegativeLimit(value, separator, limit) {
    var segments = value.split(separator);
    return segments.slice(0, limit);
}

function splitIntoEqualSegments(value, limit) {
    if (limit > 0) {
        return value.match(new RegExp('.{1,' + limit + '}', 'g'));
    } else {
        return value.split('');
    }
}