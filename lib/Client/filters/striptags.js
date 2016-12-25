/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.striptags = function zwigFilterStriptags(context, value) {
    value = stringify(value);

    var div = document.createElement('div');
    div.innerHTML = value;

    return div.textContent || div.innerText;
};