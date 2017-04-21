/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

function isNull(value) {
    return value !== undefined && value == undefined; // eslint-disable-line
}

function numberify(value) {
    return (isNaN(value) ? 0 : Number(value));
}

function stringify(value) {
    if (isNull(value) || typeof value === 'object') {
        value = '';
    } else if (typeof value === 'boolean') {
        value = value ? '1' : '';
    } else if (typeof value !== 'string') {
        value = String(value);
    }

    return value;
}