/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.abs = function zwigFilterAbs(context, value) {
    if (typeof value === 'number' || typeof value === 'boolean') {
        return Math.abs(value);
    }

    if (typeof(value) === 'object' && !isNull(value)) {
        return '';
    }

    return 0;
};