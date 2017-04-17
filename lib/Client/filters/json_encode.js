/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.json_encode = function zwigFilterJsonEncode(context, value) {
    if (typeof value === 'object' || typeof value === 'string') {
        return JSON.stringify(stringify(value));
    }

    return value;
};