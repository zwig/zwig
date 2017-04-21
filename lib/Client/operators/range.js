/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Operators.range = function zwigOperatorRange(lhs, rhs) {
    var isString = typeof lhs === 'string';

    if (isString) {
        lhs = lhs.charCodeAt(0);
        rhs = rhs.charCodeAt(0);
    }

    var list = lhs < rhs ? rangeUpwards(lhs, rhs) : rangeDownwards(lhs, rhs);

    if (isString) {
        list = rangeCharList(list);
    }

    return list;
};

function rangeUpwards(lhs, rhs) {
    var list = [];
    for (var i = lhs; i <= rhs; i++) {
        list.push(i);
    }

    return list;
}

function rangeDownwards(lhs, rhs) {
    return rangeUpwards(rhs, lhs).reverse();
}

function rangeCharList(list) {
    for (var i = 0; i < list.length; i++) {
        list[i] = String.fromCharCode(list[i]);
    }

    return list;
}