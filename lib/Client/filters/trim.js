/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.trim = function zwigFilterTrim(value, search) {
    value = stringify(value);

    if (typeof search == 'undefined') {
        search = '\\s';
    }

    return value.replace(new RegExp('^[' + search + ']+|[' + search + ']+$', 'g'), '');
};