Zwig.Templates.hellotwig = function(context) {
  return (function(zwig, functions, filters, context) {
    var html = '';
    html += "Hello ";html += filters['escape'](filters['title'](context.get("name")), 'html',null,true);
    return html;
  })(Zwig, Zwig.Functions, Zwig.Filters, context);
};