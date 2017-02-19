<div class="button-container">
    <button class="btn btn-primary" data-action="save">{{translate 'Save'}}</button>
    <button class="btn btn-default" data-action="cancel">{{translate 'Cancel'}}</button>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="cell form-group" data-name="enabled">
            <label class="control-label" data-name="enabled">{{translate 'enabled' scope='Integration' category='fields'}}</label>
            <div class="field" data-name="enabled">{{{enabled}}}</div>
        </div>
        {{#each dataFieldList}}
            <div class="cell form-group" data-name="{{./this}}">
                <label class="control-label" data-name="{{./this}}">{{translate this scope='Integration' category='fields'}}</label>
                <div class="field" data-name="{{./this}}">{{{var this ../this}}}</div>
            </div>
        {{/each}}
    </div>
    <div class="col-sm-6">
        {{#if helpText}}
        <div class="well">
            {{{../helpText}}}
        </div>
        {{/if}}
    </div>
</div>
