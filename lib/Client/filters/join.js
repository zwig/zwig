/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.join = function zwigFilterJoin(value, glue) {
    if (typeof glue === 'undefined') {
        glue = '';
    }

    if (typeof value !== 'object' || isNull(value)) {
        return stringify(value);
    }

    if (!('join' in value)) {
        return joinObject(value, glue);
    }

    return value.join(glue);
};

function joinObject(value, glue) {
    var parts = [];
    for (var key in value) {
        if (value.hasOwnProperty(key)) {
            if (typeof value[key] === 'object') {
                parts.push('Array');
            } else {
                parts.push(value[key]);
            }
        }
    }

    return parts.join(glue);
}