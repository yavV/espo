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

Espo.define('views/main', 'view', function (Dep) {

    return Dep.extend({

        scope: null,

        name: null,

        menu: null,

        events: {
            'click .action': function (e) {
                var $target = $(e.currentTarget);
                var action = $target.data('action');
                var data = $target.data();
                if (action) {
                    var method = 'action' + Espo.Utils.upperCaseFirst(action);
                    if (typeof this[method] == 'function') {
                        e.preventDefault();
                        this[method].call(this, data, e);
                    }
                }
            },
        },

        init: function () {
            this.scope = this.options.scope || this.scope;
            this.menu = {};

            if (this.name && this.scope) {
                this.menu = this.getMetadata().get('clientDefs.' + this.scope + '.menu.' + this.name.charAt(0).toLowerCase() + this.name.slice(1)) || {};
            }

            this.menu = Espo.Utils.cloneDeep(this.menu);

            ['buttons', 'actions', 'dropdown'].forEach(function (type) {
                this.menu[type] = this.menu[type] || [];
            }, this);
        },

        getMenu: function () {
            var menu = {};

            if (this.menu) {
                ['buttons', 'actions', 'dropdown'].forEach(function (type) {
                    (this.menu[type] || []).forEach(function (item) {
                        menu[type] = menu[type] || [];
                        if (Espo.Utils.checkActionAccess(this.getAcl(), this.model || this.scope, item)) {
                            menu[type].push(item);
                        }
                        item.name = item.action || item.name;
                    }, this);
                }, this);
            }

            return menu;
        },

        getHeader: function () {},

        buildHeaderHtml: function (arr) {
            var a = [];
            arr.forEach(function (item) {
                a.push('<div class="pull-left">' + item + '</div>');
            }, this);

            return '<div class="clearfix header-breadcrumbs">' + a.join('<div class="pull-left breadcrumb-separator"> &raquo </div>') + '</div>';
        },

        actionShowModal: function (data) {
            var view = data.view;
            if (!view) {
                return;
            };
            this.createView('modal', view, {
                model: this.model,
                collection: this.collection
            }, function (view) {
                view.render();
                this.listenTo(view, 'after:save', function () {
                    if (this.model) {
                        this.model.fetch();
                    }
                    if (this.collection) {
                        this.collection.fetch();
                    }
                }, this);
            }.bind(this));
        },

        addMenuItem: function (type, item, toBeginnig, doNotReRender) {
            item.name = item.name || item.action;
            var name = item.name;

            var index = -1;
            this.menu[type].forEach(function (data, i) {
                if (data.name === name) {
                    index = i;
                    return;
                }
            }, this);
            if (~index) {
                this.menu[type].splice(index, 1);
            }

            var method = 'push';
            if (toBeginnig) {
                method  = 'unshift';
            }
            this.menu[type][method](item);

            if (!doNotReRender && this.isRendered()) {
                this.getView('header').reRender();
            }
        },

        disableMenuItem: function (action) {
            this.$el.find('.header .header-buttons [data-action="'+action+'"]').addClass('disabled');
        },

        enableMenuItem: function (action) {
            this.$el.find('.header .header-buttons [data-action="'+action+'"]').removeClass('disabled');
        },

        removeMenuItem: function (name, doNotReRender) {
            var index = -1;
            var type = false;

            ['actions', 'dropdown', 'buttons'].forEach(function (t) {
                this.menu[t].forEach(function (item, i) {
                    if (item.name == name) {
                        index = i;
                        type = t;
                    }
                }, this);
            }, this);

            if (~index && type) {
                this.menu[type].splice(index, 1);
            }

            if (!doNotReRender && this.isRendered()) {
                this.getView('header').reRender();
            }
        },

        actionNavigateToRoot: function (data, e) {
            e.stopPropagation();

            this.getRouter().checkConfirmLeaveOut(function () {
                var options = {
                    isReturn: true
                };
                this.getRouter().dispatch(this.scope, null, options);
                this.getRouter().navigate('#' + this.scope, {trigger: false});
            }, this);
        },

        hideHeaderActionItem: function (name) {
            ['actions', 'dropdown', 'buttons'].forEach(function (t) {
                this.menu[t].forEach(function (item, i) {
                    if (item.name == name) {
                        item.hidden = true;
                    }
                }, this);
            }, this);
            if (!this.isRendered()) return;
            this.$el.find('.page-header li > .action[data-action="'+name+'"]').parent().addClass('hidden');
            this.$el.find('.page-header a.action[data-action="'+name+'"]').addClass('hidden');
        },

        showHeaderActionItem: function (name) {
            ['actions', 'dropdown', 'buttons'].forEach(function (t) {
                this.menu[t].forEach(function (item, i) {
                    if (item.name == name) {
                        item.hidden = false;
                    }
                }, this);
            }, this);
            if (!this.isRendered()) return;
            this.$el.find('.page-header li > .action[data-action="'+name+'"]').parent().removeClass('hidden');
            this.$el.find('.page-header a.action[data-action="'+name+'"]').removeClass('hidden');
        }

    });
});


