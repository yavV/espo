/**
 * Created by yav on 19.02.17.
 */
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2017 Yuri Kuznetsov, Taras Machyshyn, Oleksiy Avramenko
 * Website: http://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

Espo.define('smail:views/compose', 'views/modals/edit', function (Dep) {

    return Dep.extend({

        scope: 'Smail',

        layoutName: 'composeSmall',

        saveDisabled: true,

        fullFormDisabled: true,

        columnCount: 2,

        setup: function () {
            Dep.prototype.setup.call(this);

            this.buttonList.unshift({
                name: 'send',
                text: this.translate('Send', 'labels', 'Email'),
                style: 'primary'
            });

            this.header = this.getLanguage().translate('Compose Email');
        },

        createRecordView: function (model, callback) {
            var view = this.getMetadata().get('clientDefs.' + model.name + '.recordViews.compose') || 'smail:views/recordcompose';
            var options = {
                model: model,
                //model: 'Smail',
                el: this.containerSelector + ' .edit-container',
                type: 'editSmall',
                layoutName: this.layoutName || 'detailSmall',
                columnCount: this.columnCount,
                buttonsPosition: false,
                selectTemplateDisabled: this.options.selectTemplateDisabled,
                signatureDisabled: this.options.signatureDisabled,
                exit: function () {}
            };
            this.createView('edit', view, options, callback);
        },

        actionSend: function () {
            var dialog = this.dialog;

            var editView = this.getView('edit');

            var model = editView.model;

            var afterSend = function () {
                this.trigger('after:save', model);
                this.trigger('after:send', model);
                dialog.close();
            };

            editView.once('after:send', afterSend, this);

            this.disableButton('send');
            this.disableButton('saveDraft');

            editView.once('cancel:save', function () {
                this.enableButton('send');
                this.enableButton('saveDraft');

                editView.off('after:save', afterSend);
            }, this);

            editView.send();
        },


    });
});

