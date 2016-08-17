/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.capitalize = function zwigFilterCapitalize(context, value) {
    value = stringify(value);

    if (value.length === 0) {
        return '';
    }

    return value[0].toUpperCase() + value.slice(1).toLowerCase();
};