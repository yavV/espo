<div class="row">
    {{#each fieldList}}
    <div class="cell form-group col-sm-6 col-md-12{{#if hidden}} hidden-cell{{/if}}" data-name="{{name}}">
        <label class="control-label{{#if hidden}} hidden{{/if}}" data-name="{{name}}">
            {{translate name scope=../model.name category='fields'}}
        </label>
        <div class="field{{#if hidden}} hidden{{/if}}" data-name="{{name}}">
        {{{var name ../this}}}
        </div>
    </div>
    {{/each}}
</div>
