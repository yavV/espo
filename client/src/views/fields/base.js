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

Espo.define('views/fields/base', 'view', function (Dep) {

    return Dep.extend({

        type: 'base',

        listTemplate: 'fields/base/list',

        listLinkTemplate: 'fields/base/list-link',

        detailTemplate: 'fields/base/detail',

        editTemplate: 'fields/base/edit',

        searchTemplate: 'fields/base/search',

        validations: ['required'],

        name: null,

        defs: null,

        params: null,

        mode: null,

        searchParams: null,

        _timeout: null,

        inlineEditDisabled: false,

        disabled: false,

        readOnly: false,

        attributeList: null,

        initialAttributes: null,

        isRequired: function () {
            return this.params.required;
        },

        /**
         * Get cell element. Works only after rendered.
         * {jQuery}
         */
        getCellElement: function () {
            return this.$el.parent();
        },

        setDisabled: function (locked) {
            this.disabled = true;
            if (locked) {
                this.disabledLocked = true;
            }
        },

        setNotDisabled: function () {
            if (this.disabledLocked) return;
            this.disabled = false;
        },

        setRequired: function () {
            this.params.required = true;
        },

        setNotRequired: function () {
            this.params.required = false;
            this.getCellElement().removeClass('has-error');
        },

        setReadOnly: function (locked) {
            if (this.readOnlyLocked) return;
            this.readOnly = true;
            if (locked) {
                this.readOnlyLocked = true;
            }
            if (this.mode == 'edit') {
                this.setMode('detail');
                if (this.isRendered()) {
                    this.reRender();
                }
            }
        },

        setNotReadOnly: function () {
            if (this.readOnlyLocked) return;
            this.readOnly = false;
        },

        /**
         * Get label element. Works only after rendered.
         * {jQuery}
         */
        getLabelElement: function () {
            return this.$el.parent().children('label');
        },

        /**
         * Hide field and label. Works only after rendered.
         */
        hide: function () {
            this.$el.addClass('hidden');
            var $cell = this.getCellElement();
            $cell.children('label').addClass('hidden');
            $cell.addClass('hidden-cell');
        },

        /**
         * Show field and label. Works only after rendered.
         */
        show: function () {
            this.$el.removeClass('hidden');
            var $cell = this.getCellElement();
            $cell.children('label').removeClass('hidden');
            $cell.removeClass('hidden-cell');
        },

        data: function () {
            var data = {
                scope: this.model.name,
                name: this.name,
                defs: this.defs,
                params: this.params,
                value: this.getValueForDisplay()
            };
            if (this.mode === 'search') {
                data.searchParams = this.searchParams;
                data.searchData = this.searchData;
                data.searchValues = this.getSearchValues();
                data.searchType = this.getSearchType();
                data.searchTypeList = this.getSearchTypeList();
            }
            return data;
        },

        getValueForDisplay: function () {
            return this.model.get(this.name);
        },

        setMode: function (mode) {
            this.mode = mode;
            var property = mode + 'Template';
            if (!(property in this)) {
                this[property] = 'fields/' + Espo.Utils.camelCaseToHyphen(this.type) + '/' + this.mode;
            }
            this.template = this[property];
        },

        init: function () {
            if (this.events) {
                this.events = _.clone(this.events);
            } else {
                this.events = {};
            }

            this.defs = this.options.defs || {};
            this.name = this.options.name || this.defs.name;
            this.params = this.options.params || this.defs.params || {};

            this.fieldType = this.model.getFieldParam(this.name, 'type') || this.type;

            this.getFieldManager().getParamList(this.type).forEach(function (d) {
                var name = d.name;
                if (!(name in this.params)) {
                    this.params[name] = this.model.getFieldParam(this.name, name) || null;
                }
            }, this);

            this.mode = this.options.mode || this.mode;

            this.readOnly = this.readOnly || this.params.readOnly || this.model.getFieldParam(this.name, 'readOnly');
            this.readOnlyLocked = this.options.readOnlyLocked || this.readOnly;
            this.inlineEditDisabled = this.options.inlineEditDisabled || this.params.inlineEditDisabled || this.inlineEditDisabled;
            this.readOnly = this.readOnlyLocked || this.options.readOnly || false;

            this.tooltip = this.options.tooltip || this.params.tooltip || this.model.getFieldParam(this.name, 'tooltip');

            if (this.options.readOnlyDisabled) {
                this.readOnly = false;
            }

            this.disabledLocked = this.options.disabledLocked || false;
            this.disabled = this.disabledLocked || this.options.disabled || this.disabled;

            if (this.mode == 'edit' && this.readOnly) {
                this.mode = 'detail';
            }

            this.setMode(this.mode || 'detail');

            if (this.mode == 'search') {
                this.searchParams = _.clone(this.options.searchParams || {});
                this.searchData = {};
                this.setupSearch();
            }

            this.on('invalid', function () {
                var $cell = this.getCellElement();
                $cell.addClass('has-error');
                this.$el.one('click', function () {
                    $cell.removeClass('has-error');
                });
                this.once('render', function () {
                    $cell.removeClass('has-error');
                });
            }, this);

            if (this.mode == 'edit' && this.isRequired()) {
                this.once('after:render', function () {
                    this.getLabelElement().append(' *');
                }, this);
            }

            if ((this.mode == 'detail' || this.mode == 'edit') && this.tooltip) {
                var $a;
                this.once('after:render', function () {
                    $a = $('<a href="javascript:" class="text-muted"><span class="glyphicon glyphicon-info-sign"></span></a>');
                    var $label = this.getLabelElement();
                    $label.append(' ');
                    this.getLabelElement().append($a);
                    $a.popover({
                        placement: 'bottom',
                        container: 'body',
                        html: true,
                        content: (this.options.tooltipText || this.translate(this.name, 'tooltips', this.model.name)).replace(/\n/g, "<br />"),
                        trigger: 'click',
                    }).on('shown.bs.popover', function () {
                        $('body').one('click', function () {
                            $a.popover('hide');
                        });
                    });
                }, this);
                this.on('remove', function () {
                    if ($a) {
                        $a.popover('destroy')
                    }
                }, this);
            }

            if (this.mode == 'detail') {
                if (!this.inlineEditDisabled) {
                    this.listenToOnce(this, 'after:render', this.initInlineEdit, this);
                }
            }

            if (this.mode != 'search') {
                this.attributeList = this.getAttributeList();

                this.listenTo(this.model, 'change', function (model, options) {
                    if (this.isRendered() || this.isBeingRendered()) {
                        if (options.ui) {
                            return;
                        }

                        var changed = false;
                        this.attributeList.forEach(function (attribute) {
                            if (model.hasChanged(attribute)) {
                                changed = true;
                            }
                        });

                        if (changed) {
                            this.reRender();
                        }
                    }
                }.bind(this));

                this.listenTo(this, 'change', function () {
                    var attributes = this.fetch();
                    this.model.set(attributes, {ui: true});
                });
            }
        },

        getSearchParamsData: function () {
            return this.searchParams.data || {};
        },

        getSearchValues: function () {
            return this.getSearchParamsData().values || {};
        },

        getSearchType: function () {
            return this.getSearchParamsData().type || this.searchParams.type;
        },

        getSearchTypeList: function () {
            return this.searchTypeList;
        },

        initInlineEdit: function () {
            var $cell = this.getCellElement();
            var $editLink = $('<a href="javascript:" class="pull-right inline-edit-link hidden"><span class="glyphicon glyphicon-pencil"></span></a>');

            if ($cell.size() == 0) {
                this.listenToOnce(this, 'after:render', this.initInlineEdit, this);
                return;
            }

            $cell.prepend($editLink);

            $editLink.on('click', function () {
                this.inlineEdit();
            }.bind(this));

            $cell.on('mouseenter', function (e) {
                e.stopPropagation();
                if (this.disabled || this.readOnly) {
                    return;
                }
                if (this.mode == 'detail') {
                    $editLink.removeClass('hidden');
                }
            }.bind(this)).on('mouseleave', function (e) {
                e.stopPropagation();
                if (this.mode == 'detail') {
                    $editLink.addClass('hidden');
                }
            }.bind(this));
        },

        initElement: function () {
            this.$element = this.$el.find('[name="' + this.name + '"]');
            if (this.mode == 'edit') {
                this.$element.on('change', function () {
                    this.trigger('change');
                }.bind(this));
            }
        },

        afterRender: function () {
            if (this.mode == 'edit' || this.mode == 'search') {
                this.initElement();
            }
        },

        setup: function () {},

        setupSearch: function () {},

        getAttributeList: function () {
            return this.getFieldManager().getAttributes(this.fieldType, this.name);
        },

        inlineEditSave: function () {
            var data = this.fetch();

            var self = this;
            var model = this.model;
            var prev = this.initialAttributes;

            model.set(data, {silent: true});
            data = model.attributes;

            var attrs = false;
            for (var attr in data) {
                if (_.isEqual(prev[attr], data[attr])) {
                    continue;
                }
                (attrs || (attrs = {}))[attr] =    data[attr];
            }

            if (!attrs) {
                this.inlineEditClose();
                return;
            }

            if (this.validate()) {
                this.notify('Not valid', 'error');
                model.set(prev, {silent: true});
                return;
            }

            this.notify('Saving...');
            model.save(attrs, {
                success: function () {
                    self.trigger('after:save');
                    model.trigger('after:save');
                    self.notify('Saved', 'success');
                },
                error: function () {
                    self.notify('Error occured', 'error');
                    model.set(prev, {silent: true});
                    self.render()
                },
                patch: true
            });
            this.inlineEditClose(true);
        },

        removeInlineEditLinks: function () {
            var $cell = this.getCellElement();
            $cell.find('.inline-save-link').remove();
            $cell.find('.inline-cancel-link').remove();
            $cell.find('.inline-edit-link').addClass('hidden');
        },

        addInlineEditLinks: function () {
            var $cell = this.getCellElement();
            var $saveLink = $('<a href="javascript:" class="pull-right inline-save-link">' + this.translate('Update') + '</a>');
            var $cancelLink = $('<a href="javascript:" class="pull-right inline-cancel-link">' + this.translate('Cancel') + '</a>');
            $cell.prepend($saveLink);
            $cell.prepend($cancelLink);
            $cell.find('.inline-edit-link').addClass('hidden');
            $saveLink.click(function () {
                this.inlineEditSave();
            }.bind(this));
            $cancelLink.click(function () {
                this.inlineEditClose();
            }.bind(this));
        },

        inlineEditClose: function (dontReset) {
            this.trigger('inline-edit-off');
            if (this.mode != 'edit') {
                return;
            }

            this.setMode('detail');
            this.once('after:render', function () {
                this.removeInlineEditLinks();
            }, this);

            if (!dontReset) {
                this.model.set(this.initialAttributes);
            }

            this.render();
        },

        inlineEdit: function () {
            var self = this;

            this.trigger('edit', this);
            this.setMode('edit');

            this.initialAttributes = this.model.getClonedAttributes();

            this.once('after:render', function () {
                this.addInlineEditLinks();
            }, this);

            this.render();
            this.trigger('inline-edit-on');
        },

        showValidationMessage: function (message, selector) {
            selector = selector || '.main-element';

            var $el = this.$el.find(selector);
            if (!$el.size() && this.$element) {
                $el = this.$element;
            }
            $el.popover({
                placement: 'bottom',
                container: 'body',
                content: message,
                trigger: 'manual',
            }).popover('show');

            $el.closest('.field').one('mousedown click', function () {
                $el.popover('destroy');
            });

            this.once('render remove', function () {
                if ($el) {
                    $el.popover('destroy');
                }
            });

            if (this._timeout) {
                clearTimeout(this._timeout);
            }

            this._timeout = setTimeout(function () {
                $el.popover('destroy');
            }, 3000);
        },

        validate: function () {
            for (var i in this.validations) {
                var method = 'validate' + Espo.Utils.upperCaseFirst(this.validations[i]);
                if (this[method].call(this)) {
                    this.trigger('invalid');
                    return true;
                }
            }
            return false;
        },

        validateRequired: function () {
            if (this.isRequired()) {
                if (this.model.get(this.name) === '') {
                    var msg = this.translate('fieldIsRequired', 'messages').replace('{field}', this.translate(this.name, 'fields', this.model.name));
                    this.showValidationMessage(msg);
                    return true;
                }
            }
        },

        fetchToModel: function () {
            this.model.set(this.fetch(), {silent: true});
        },

        fetch: function () {
            var data = {};
            data[this.name] = this.$element.val();
            return data;
        },

        fetchSearch: function () {
            var value = this.$element.val().toString().trim();
            if (value) {
                var data = {
                    type: 'equals',
                    value: value
                };
                return data;
            }
            return false;
        },
    });
});

