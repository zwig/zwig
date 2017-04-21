/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.title = function zwigFilterTitle(context, value) {
    value = stringify(value);

    return value.toLowerCase().replace(/^.|\s.|-.|_./g, function (match) {
        return match.toUpperCase();
    });
};