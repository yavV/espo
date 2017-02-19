
<div>
{{#each emailAddressData}}
    <div class="input-group email-address-block">        
        <input type="email" class="form-control email-address" value="{{emailAddress}}" autocomplete="off">
        <span class="input-group-btn">
            <button class="btn btn-default email-property{{#if primary}} active{{/if}} hidden" type="button" tabindex="-1" data-action="switchEmailProperty" data-property-type="primary" data-toggle="tooltip" data-placement="top" title="{{translate 'Primary' scope='EmailAddress'}}">
                <span class="glyphicon glyphicon-star{{#unless primary}} text-muted{{/unless}}"></span>
            </button>
            <button class="btn btn-default email-property{{#if optOut}} active{{/if}}" type="button" tabindex="-1" data-action="switchEmailProperty" data-property-type="optOut" data-toggle="tooltip" data-placement="top" title="{{translate 'Opted Out' scope='EmailAddress'}}">
                <span class="glyphicon glyphicon-ban-circle{{#unless optOut}} text-muted{{/unless}}"></span>
            </button>
            <button class="btn btn-default email-property{{#if invalid}} active{{/if}}" type="button" tabindex="-1" data-action="switchEmailProperty" data-property-type="invalid" data-toggle="tooltip" data-placement="top" title="{{translate 'Invalid' scope='EmailAddress'}}">
                <span class="glyphicon glyphicon-exclamation-sign{{#unless invalid}} text-muted{{/unless}}"></span>
            </button>
            <button class="btn btn-link hidden" style="margin-left: 5px;" type="button" tabindex="-1" data-action="removeEmailAddress" data-property-type="invalid" data-toggle="tooltip" data-placement="top" title="{{translate 'Remove'}}">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
        </span>
    </div>
{{/each}}
</div>

<button class="btn btn-default" type="button" data-action="addEmailAddress"><span class="glyphicon glyphicon-plus"></span></button>

