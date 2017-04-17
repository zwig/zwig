/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.url_encode = function zwigFilterUrlEncode(context, value) {
    if (typeof value === 'object') {
        var key, keypairs = [];
        for (key in value) {
            if (value.hasOwnProperty(key)) {
                keypairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(value[key]));
            }
        }

        return keypairs.join('&');
    }

    return encodeURIComponent(value);
};