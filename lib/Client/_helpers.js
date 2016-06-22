/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

function isNull(value) {
    return value !== undefined && value == undefined; // jshint ignore:line
}

function stringify(value) {
    if (isNull(value) || typeof value == 'object') {
        value = '';
    } else if (typeof value == 'boolean') {
        value = value ? '1' : '';
    } else if (typeof value != 'string') {
        value = String(value);
    }

    return value;
}