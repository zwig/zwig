/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

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