/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Zwig.render = function zwigRenderTemplate(filename, data, context, ignore_missing) {
    if (typeof context == 'undefined') {
        context = new Context(data);
    } else {
        context = context.clone();
        context.fill(data);
    }

    var identifier = findTemplate(filename);
    if (!identifier) {
        if (typeof ignore_missing == 'undefined' || !ignore_missing) {
            return 'Unable to find template &quot;' + filename + '&quot;.';
        } else {
            return '';
        }
    }

    return Templates[identifier](context);
};

function findTemplate(filename) {
    var identifier;

    if (typeof filename == 'object') {
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