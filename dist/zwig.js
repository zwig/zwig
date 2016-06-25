/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

(function(){
var Zwig = window.Zwig = {};
var Templates = Zwig.Templates = {};
var Operators = Zwig.Operators = {};
var Filters = Zwig.Filters = {};

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

/**
 * Manages a key-value storage with snapshot functionality,
 * which is used to emulate Twigs behaviour of variable scopes.
 *
 * @param values <object> Initial data
 * @constructor
 */
function Context(values) {
    this.stack = [values];
    this.pointer = 0;
}

Context.prototype.get = function contextGet(key) {
    for (var i = this.pointer; i >= 0; --i) {
        if (key in this.stack[i]) {
            return this.stack[i][key];
        }
    }

    return undefined;
};

Context.prototype.set = function contextSet(key, value) {
    for (var i = 0; i < this.stack.length - 1; i++) {
        if (key in this.stack[i]) {
            this.stack[i][key] = value;
            return;
        }
    }

    this.stack[this.pointer][key] = value;
};

Context.prototype.push = function contextPush() {
    this.stack.push({});
    this.pointer++;
};

Context.prototype.pop = function contextPop() {
    if (this.pointer > 0) {
        this.stack.pop();
        this.pointer--;
    }
};

Context.prototype.clone = function contextClone() {
    var values = {};

    for (var i = this.pointer; i >= 0; i--) {
        for (var key in this.stack[i]) {
            if (this.stack[i].hasOwnProperty(key) && !(key in values)) {
                values[key] = this.stack[i][key];
            }
        }
    }

    return new Context(values);
};

Context.prototype.fill = function contextFill(data) {
    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            this.stack[this.pointer][key] = data[key];
        }
    }
};

Zwig.render = function zwigRenderTemplate(filename, data, context, ignore_missing) {
    if (typeof context === 'undefined') {
        context = new Context(data);
    } else {
        context = context.clone();
        context.fill(data);
    }

    var identifier = findTemplate(filename);
    if (!identifier) {
        if (typeof ignore_missing === 'undefined' || !ignore_missing) {
            return 'Unable to find template &quot;' + filename + '&quot;.';
        } else {
            return '';
        }
    }

    return Templates[identifier](context);
};

function findTemplate(filename) {
    var identifier;

    if (typeof filename === 'object') {
        for (var i = 0; i < filename.length; i++) {
            identifier = getTemplateIdentifier(filename[i]);
            if (identifier in Templates) {
                return identifier;
            }
        }
    } else {
        identifier = getTemplateIdentifier(filename);
        if (identifier in Templates) {
            return identifier;
        }
    }

    return undefined;
}

function getTemplateIdentifier(filename) {
    // First delete everything that is no letter, digit, underscore, slash or backslash
    // and then replace directory separators with two underscores.
    return filename.replace(/([^\w/\\])/, '').replace(/([/\\])/, '__');
}

Operators.add = function zwigOperatorAdd(lhs, rhs) {
    return numberify(lhs) + numberify(rhs);
};

Operators.concat = function zwigOperatorConcat(lhs, rhs) {
    return concatParamToString(lhs) + concatParamToString(rhs);
};

function concatParamToString(value) {
    return typeof value === 'object' && !isNull(value)? 'Array' : stringify(value);
}

Operators.div = function zwigOperatorDiv(lhs, rhs) {
    return numberify(lhs) / numberify(rhs);
};

Operators.floordiv = function zwigOperatorFloorDiv(lhs, rhs) {
    return Math.floor(Operators.div(lhs, rhs));
};

Operators.in = function zwigOperatorIn(needle, haystack) {
    if (typeof haystack === 'string') {
        return inString(haystack, needle);
    }

    if (typeof haystack.length === 'undefined') {
        return inObject(haystack, needle);
    }

    return inList(haystack, needle);
};

function inString(haystack, needle) {
    return haystack.indexOf(needle) !== -1;
}

function inObject(haystack, needle) {
    for (var key in haystack) {
        if (haystack.hasOwnProperty(key)) {
            if (haystack[key] == needle) { // eslint-disable-line
                return true;
            }
        }
    }

    return false;
}

function inList(haystack, needle) {
    for (var i = 0; i < haystack.length; i++) {
        if (haystack[i] == needle) { // eslint-disable-line
            return true;
        }
    }

    return false;
}

Operators.matches = function zwigOperatorMatches(value, expr) {
    if (typeof value === 'object') {
        return false;
    }

    var segments = expr.match(/^\/(.+)\/(.?)$/);
    var regex = segments ? segments[1] : expr;
    var option = segments ? segments[2] : '';

    value = stringify(value);

    return value.match(new RegExp(regex, option));
};

Operators.mod = function zwigOperatorMod(lhs, rhs) {
    return (isNaN(lhs) ? 0 : Math.floor(lhs)) % (isNaN(rhs) ? 0 : Math.floor(rhs));
};

Operators.mul = function zwigOperatorMul(lhs, rhs) {
    return numberify(lhs) * numberify(rhs);
};

Operators.power = function zwigOperatorPower(lhs, rhs) {
    return Math.pow(
        isNaN(lhs) ? 0 : Number(lhs),
        isNaN(rhs) ? 0 : Number(rhs)
    );
};

Operators.range = function zwigOperatorRange(lhs, rhs) {
    var isString = typeof lhs === 'string';

    if (isString) {
        lhs = lhs.charCodeAt(0);
        rhs = rhs.charCodeAt(0);
    }

    var list = lhs < rhs ? rangeUpwards(lhs, rhs) : rangeDownwards(lhs, rhs);

    if (isString) {
        list = rangeCharList(list);
    }

    return list;
};

function rangeUpwards(lhs, rhs) {
    var list = [];
    for (var i = lhs; i <= rhs; i++) {
        list.push(i);
    }

    return list;
}

function rangeDownwards(lhs, rhs) {
    var list = rangeUpwards(rhs, lhs);
    list.reverse();
    return list;
}

function rangeCharList(list) {
    for (var i = 0; i < list.length; i++) {
        list[i] = String.fromCharCode(list[i]);
    }

    return list;
}

Operators.startsWith = function zwigOperatorStartsWith(haystack, needle) {
    return checkStringBoundaries(haystack, needle, 'startsWith', startsWithPolyFill);
};

Operators.endsWith = function zwigOperatorEndsWith(haystack, needle) {
    return checkStringBoundaries(haystack, needle, 'endsWith', endsWithPolyFill);
};

function checkStringBoundaries(haystack, needle, nativeName, polyFill) {
    if (typeof haystack !== 'string' || typeof needle !== 'string') {
        return false;
    }

    // use the native function if available
    if (typeof haystack[nativeName] !== 'undefined') {
        return haystack[nativeName](needle);
    }

    return polyFill(haystack, needle);
}

function startsWithPolyFill(haystack, needle) {
    if (haystack.length < needle.length) {
        return false;
    }

    for (var i = 0; i < needle.length; i++) {
        if (haystack[i] !== needle[i]) {
            return false;
        }
    }

    return true;
}

function endsWithPolyFill(haystack, needle) {
    if (haystack.length < needle.length) {
        return false;
    }

    for (var i = 1; i <= needle.length; i++) {
        if (haystack[haystack.length - i] !== needle[needle.length - i]) {
            return false;
        }
    }

    return true;
}

Operators.sub = function zwigOperatorSub(lhs, rhs) {
    return numberify(lhs) - numberify(rhs);
};

Filters.abs = function zwigFilterAbs(value) {
    if (typeof value === 'number' || typeof value === 'boolean') {
        return Math.abs(value);
    }

    if (typeof(value) === 'object' && !isNull(value)) {
        return '';
    }

    return 0;
};

Filters.capitalize = function zwigFilterCapitalize(value) {
    value = stringify(value);

    if (value.length === 0) {
        return '';
    }

    return value[0].toUpperCase() + value.slice(1).toLowerCase();
};

function zwigFilterEscape(value) {
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

Filters.join = function zwigFilterJoin(value, glue) {
    if (typeof glue === 'undefined') {
        glue = '';
    }

    if (typeof value !== 'object' || isNull(value)) {
        return stringify(value);
    }

    if (!('join' in value)) {
        return joinObject(value, glue);
    }

    return value.join(glue);
};

function joinObject(value, glue) {
    var parts = [];
    for (var key in value) {
        if (value.hasOwnProperty(key)) {
            if (typeof value[key] === 'object') {
                parts.push('Array');
            } else {
                parts.push(value[key]);
            }
        }
    }

    return parts.join(glue);
}

Filters.nl2br = function zwigFilterNl2br(value) {
    return value.replace('\n', '<br />');
};

Filters.split = function zwigFilterSplit(value, separator, limit) {
    if (typeof separator === 'undefined') {
        separator = '';
    }

    // Weird PHP peculiarity #1
    if (isNull(value)) {
        return [''];
    }

    // Weird PHP peculiarity #2
    if (value === '' || limit === 0) {
        return [value];
    }

    value = stringify(value);

    // We can use the vanilla split method when no limit is specified.
    if (typeof limit === 'undefined') {
        return value.split(separator);
    }

    return splitWithLimit(value, separator, limit);
};

function splitWithLimit(value, separator, limit) {
    // The PHP explode function has a lot of exceptions.
    // Like the handling when using an empty separator.
    // See http://php.net/explode
    if (separator === '') {
        return splitIntoEqualSegments(value, limit);
    }

    if (limit > 0) {
        return splitWithPositiveLimit(value, separator, limit);
    } else {
        return splitWithNegativeLimit(value, separator, limit);
    }
}

function splitWithPositiveLimit(value, separator, limit) {
    var segments = value.split(separator, limit);
    var length = 0;

    for (var i = 0; i < segments.length; i++) {
        length += segments[i].length;
    }

    length += (segments.length - 1) * separator.length;

    if (length < value.length) {
        segments[segments.length - 1] += value.substr(length, value.length - length);
    }

    return segments;
}

function splitWithNegativeLimit(value, separator, limit) {
    var segments = value.split(separator);
    return segments.slice(0, limit);
}

function splitIntoEqualSegments(value, limit) {
    if (limit > 0) {
        return value.match(new RegExp('.{1,' + limit + '}', 'g'));
    } else {
        return value.split('');
    }
}

Filters.title = function zwigFilterTitle(value) {
    value = stringify(value);

    return value.toLowerCase().replace(/^.|\s.|-.|_./g, function (match) {
        return match.toUpperCase();
    });
};

Filters.trim = function zwigFilterTrim(value, search) {
    value = stringify(value);

    if (typeof search === 'undefined') {
        search = '\\s';
    }

    return value.replace(new RegExp('^[' + search + ']+|[' + search + ']+$', 'g'), '');
};
})();