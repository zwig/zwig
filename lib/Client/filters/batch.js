/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.batch = function zwigFilterBatch(context, value, count, filler) {
    var lastGroup, groups = [];
    for (var i = 0; i < value.length; i += count) {
        groups.push(value.slice(i, i + count));
    }

    lastGroup = groups[groups.length - 1];
    while (lastGroup.length < count) {
        lastGroup.push(filler);
    }

    return groups;
};