/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

//noinspection JSUnusedLocalSymbols
function zwigFilterEscape(context, value) {
    // Adapted from an StackOverflow answer by user Anentropic.
    // http://stackoverflow.com/questions/1219860/html-encoding-in-javascript-jquery#answer-7124052
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/\//g, '&#x2F;');
}

Filters.escape = zwigFilterEscape;
Filters.e = zwigFilterEscape;