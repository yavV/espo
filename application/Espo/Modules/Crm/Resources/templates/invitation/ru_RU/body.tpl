<p>Название: {{name}}</p>
<p>Начало: {{dateStart}}</p>
{{#if isUser}}
    {{#if description}}
    <p>{{{description}}}</p>
    {{/if}}
{{/if}}
<p>
<a href="{{acceptLink}}">Принять</a>, <a href="{{declineLink}}">Отклонить</a>, <a href="{{tentativeLink}}">Не уверен</a>
</p>
{{#if isUser}}
<p><a href="{{recordUrl}}">Открыть запись</a></p>
{{/if}}