
{{#unless isNew}}
<a href="javascript:" data-action="change">{{translate 'change'}}</a>
{{/unless}}
<input type="password" class="main-element form-control {{#unless isNew}}hidden{{/unless}}" name="{{name}}" value="{{value}}">


