Zwig.Templates.hellotwig = function(context) {
  return (function(zwig, operators, filters, context) {
    var html = '';
    html += "Hello ";html += filters['escape'](context, filters['title'](context, context.get("name")), 'html',null,true);
    return html;
  })(Zwig, Zwig.Operators, Zwig.Filters, context);
};