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

Espo.define('views/email-account/record/edit', ['views/record/edit', 'views/email-account/record/detail'], function (Dep, Detail) {

    return Dep.extend({

        afterRender: function () {
            Dep.prototype.afterRender.call(this);

            Detail.prototype.initSslFieldListening.call(this);
            Detail.prototype.initSmtpFieldsControl.call(this);

            if (Detail.prototype.wasFetched.call(this)) {
                this.setFieldReadOnly('fetchSince');
            }

            if (this.getUser().isAdmin()) {
                var fieldView = this.getFieldView('assignedUser');
                if (fieldView) {
                    fieldView.readOnly = false;
                    fieldView.setMode('edit');
                    fieldView.render();
                }
            }
        },

        controlSmtpFields: function () {
            Detail.prototype.controlSmtpFields.call(this);
        },

        controlSmtpAuthField: function () {
            Detail.prototype.controlSmtpAuthField.call(this);
        }

    });

});

