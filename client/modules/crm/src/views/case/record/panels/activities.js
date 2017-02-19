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

Espo.define('crm:views/case/record/panels/activities', 'crm:views/record/panels/activities', function (Dep) {

    return Dep.extend({

        getComposeEmailAttributes: function (scope, data, callback) {
            data = data || {};
            var attributes = {
                status: 'Draft',
                name: '[#' + this.model.get('number') + '] ' + this.model.get('name')
            };

            Espo.Ui.notify(this.translate('pleaseWait', 'messages'));

            var parentModel = this.model;

            new Promise(function (resolve, reject) {
                if (parentModel.get('contactsIds') && parentModel.get('contactsIds').length) {
                    this.getCollectionFactory().create('Contact', function (contactList) {
                        var contactListFinal = [];
                        contactList.url = 'Case/' + parentModel.id + '/contacts';
                        contactList.fetch().then(function () {
                            contactList.forEach(function (contact) {
                                if (contact.id == parentModel.get('contactId')) {
                                    contactListFinal.unshift(contact);
                                } else {
                                    contactListFinal.push(contact);
                                }
                            });
                            resolve(contactListFinal);
                        }, function () {resolve([])});
                    }, this);
                } else if (parentModel.get('accountId')) {
                    this.getModelFactory().create('Account', function (account) {
                        account.id = parentModel.get('accountId');
                        account.fetch().then(function () {
                            resolve([account]);
                        }, function () {resolve([])});
                    }, this);
                } else if (parentModel.get('leadId')) {
                    this.getModelFactory().create('Lead', function (account) {
                        lead.id = parentModel.get('leadId');
                        lead.fetch().then(function () {
                            resolve([lead]);
                        }, function () {resolve([])});
                    }, this);
                } else {
                    resolve([]);
                }
            }.bind(this)).then(function (list) {
                attributes.to = '';
                attributes.cc = '';
                attributes.nameHash = {};

                list.forEach(function (model, i) {
                    if (model.get('emailAddress')) {
                        if (i === 0) {
                            attributes.to += model.get('emailAddress') + ';';
                        } else {
                            attributes.cc += model.get('emailAddress') + ';';
                        }
                        attributes.nameHash[model.get('emailAddress')] = model.get('name');
                    }
                });
                Espo.Ui.notify(false);

                callback.call(this, attributes);

            }.bind(this));
        }
    });
});

