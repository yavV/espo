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

Espo.define('views/record/detail', ['views/record/base', 'view-record-helper'], function (Dep, ViewRecordHelper) {

    return Dep.extend({

        template: 'record/detail',

        type: 'detail',

        name: 'detail',

        layoutName: 'detail',

        fieldsMode: 'detail',

        gridLayout: null,

        detailLayout: null,

        /**
         * @property {string} or {bool} ['both', 'top', 'bottom', false, true] Where to display buttons.
         */
        buttonsPosition: 'top',

        columnCount: 2,

        scope: null,

        isNew: false,

        buttonList: [
            {
                name: 'edit',
                label: 'Edit',
                style: 'primary',
            }
        ],

        dropdownItemList: [
            {
                name: 'delete',
                label: 'Remove'
            }
        ],

        buttonEditList: [
            {
                name: 'save',
                label: 'Save',
                style: 'primary',
                edit: true
            },
            {
                name: 'cancelEdit',
                label: 'Cancel',
                edit: true
            }
        ],

        dropdownEditItemList: [],

        id: null,

        returnUrl: null,

        returnDispatchParams: null,

        middleView: 'views/record/detail-middle',

        sideView: 'views/record/detail-side',

        bottomView: 'views/record/detail-bottom',

        editModeDisabled: false,

        navigateButtonsDisabled: false,

        readOnly: false,

        isWide: false,

        dependencyDefs: {},

        duplicateAction: true,

        events: {
            'click .button-container .action': function (e) {
                var $target = $(e.currentTarget);
                var action = $target.data('action');
                var data = $target.data();
                if (action) {
                    var method = 'action' + Espo.Utils.upperCaseFirst(action);
                    if (typeof this[method] == 'function') {
                        this[method].call(this, data, e);
                        e.preventDefault();
                    }
                }
            }
        },

        actionEdit: function () {
            if (!this.editModeDisabled) {
                this.setEditMode();
                $(window).scrollTop(0);
            } else {
                this.getRouter().navigate('#' + this.scope + '/edit/' + this.model.id, {trigger: true});
            }
        },

        actionDelete: function () {
            this.delete();
        },

        actionSave: function () {
            if (this.save()) {
                this.setDetailMode();
                $(window).scrollTop(0)
            }
        },

        actionCancelEdit: function () {
            this.cancelEdit();
            $(window).scrollTop(0);
        },

        setupActionItems: function () {
            if (this.model.isNew()) {
                this.isNew = true;
                this.removeButton('delete');
            }

            if (this.duplicateAction) {
                if (this.getAcl().check(this.entityType, 'create')) {
                    this.dropdownItemList.push({
                        'label': 'Duplicate',
                        'name': 'duplicate'
                    });
                }
            }
        },

        hideActionItem: function (name) {
            for (var i in this.buttonList) {
                if (this.buttonList[i].name == name) {
                    this.buttonList[i].hidden = true;
                    break;
                }
            }
            for (var i in this.dropdownItemList) {
                if (this.dropdownItemList[i].name == name) {
                    this.dropdownItemList[i].hidden = true;
                    break;
                }
            }

            if (this.isRendered()) {
                this.$detailButtonContainer.find('li > .action[data-action="'+name+'"]').parent().addClass('hidden');
                this.$detailButtonContainer.find('button.action[data-action="'+name+'"]').addClass('hidden');
                if (this.isDropdownItemListEmpty()) {
                    this.$dropdownItemListButton.addClass('hidden');
                }
            }
        },

        showActionItem: function (name) {
            for (var i in this.buttonList) {
                if (this.buttonList[i].name == name) {
                    this.buttonList[i].hidden = false;
                    break;
                }
            }
            for (var i in this.dropdownItemList) {
                if (this.dropdownItemList[i].name == name) {
                    this.dropdownItemList[i].hidden = false;
                    break;
                }
            }

            if (this.isRendered()) {
                this.$detailButtonContainer.find('li > .action[data-action="'+name+'"]').parent().removeClass('hidden');
                this.$detailButtonContainer.find('button.action[data-action="'+name+'"]').removeClass('hidden');
                if (!this.isDropdownItemListEmpty()) {
                    this.$dropdownItemListButton.removeClass('hidden');
                }
            }
        },

        showPanel: function (name) {
            this.recordHelper.setPanelStateParam(name, 'hidden', false);

            var middleView = this.getView('middle');
            if (middleView) {
                middleView.showPanel(name);
            }

            var bottomView = this.getView('bottom');
            if (bottomView) {
                if ('showPanel' in bottomView) {
                    bottomView.showPanel(name);
                }
            }

            var sideView = this.getView('side');
            if (sideView) {
                if ('showPanel' in sideView) {
                    sideView.showPanel(name);
                }
            }
        },

        hidePanel: function (name) {
            this.recordHelper.setPanelStateParam(name, 'hidden', true);

            var middleView = this.getView('middle');
            if (middleView) {
                middleView.hidePanel(name);
            }

            var bottomView = this.getView('bottom');
            if (bottomView) {
                if ('hidePanel' in bottomView) {
                    bottomView.hidePanel(name);
                }
            }

            var sideView = this.getView('side');
            if (sideView) {
                if ('hidePanel' in sideView) {
                    sideView.hidePanel(name);
                }
            }
        },

        afterRender: function () {
            var $container = this.$el.find('.detail-button-container');

            var stickTop = this.getThemeManager().getParam('stickTop') || 62;
            var blockHeight = this.getThemeManager().getParam('blockHeight') || 21;

            var $block = $('<div>').css('height', blockHeight + 'px').html('&nbsp;').hide().insertAfter($container);
            var $middle = this.getView('middle').$el;
            var $window = $(window);

            var screenWidthXs = this.getThemeManager().getParam('screenWidthXs');

            $window.off('scroll.detail-' + this.numId);
            $window.on('scroll.detail-' + this.numId, function (e) {
                if ($(window.document).width() < screenWidthXs) {
                    $container.removeClass('stick-sub');
                    $block.hide();
                    $container.show();
                    return;
                }

                var edge = $middle.position().top + $middle.outerHeight(true);
                var scrollTop = $window.scrollTop();

                if (scrollTop < edge) {
                    if (scrollTop > stickTop) {
                        if (!$container.hasClass('stick-sub')) {
                            $container.addClass('stick-sub');
                            $block.show();

                            var $p = $('.popover');
                            $p.each(function (i, el) {
                                $el = $(el);
                                $el.css('top', ($el.position().top - blockHeight) + 'px');
                            });
                        }
                    } else {
                        if ($container.hasClass('stick-sub')) {
                            $container.removeClass('stick-sub');
                            $block.hide();

                            var $p = $('.popover');
                            $p.each(function (i, el) {
                                $el = $(el);
                                $el.css('top', ($el.position().top + blockHeight) + 'px');
                            });
                        }
                    }
                    $container.show();
                } else {
                    $container.hide();
                    $block.show();
                }
            }.bind(this));

            var fields = this.getFieldViews();

            var fieldInEditMode = null;
            for (var field in fields) {
                var fieldView = fields[field];
                this.listenTo(fieldView, 'edit', function (view) {
                    if (fieldInEditMode && fieldInEditMode.mode == 'edit') {
                        fieldInEditMode.inlineEditClose();
                    }
                    fieldInEditMode = view;
                }, this);

                this.listenTo(fieldView, 'inline-edit-on', function () {
                    this.inlineEditModeIsOn = true;
                }, this);
                this.listenTo(fieldView, 'inline-edit-off', function () {
                    this.inlineEditModeIsOn = false;
                    this.setIsNotChanged();
                }, this);
            }
        },

        fetch: function () {
            var data = Dep.prototype.fetch.call(this);
            if (this.hasView('side')) {
                var view = this.getView('side');
                if ('fetch' in view) {
                    data = _.extend(data, view.fetch());
                }
            }
            if (this.hasView('bottom')) {
                var view = this.getView('bottom');
                if ('fetch' in view) {
                    data = _.extend(data, view.fetch());
                }
            }
            return data;
        },

        setEditMode: function () {
            this.$el.find('.record-buttons').addClass('hidden');
            this.$el.find('.edit-buttons').removeClass('hidden');

            var fields = this.getFieldViews(true);
            for (var field in fields) {
                var fieldView = fields[field];
                if (!fieldView.readOnly) {
                    if (fieldView.mode == 'edit') {
                        fieldView.fetchToModel();
                        fieldView.removeInlineEditLinks();
                    }
                    fieldView.setMode('edit');
                    fieldView.render();
                }
            }
            this.mode = 'edit';
        },

        setDetailMode: function () {
            this.$el.find('.edit-buttons').addClass('hidden');
            this.$el.find('.record-buttons').removeClass('hidden');

            var fields = this.getFieldViews(true);
            for (var field in fields) {
                var fieldView = fields[field];
                if (fieldView.mode != 'detail') {
                    fieldView.setMode('detail');
                    fieldView.render();
                }
            }
            this.mode = 'detail';
        },

        cancelEdit: function () {
            this.model.set(this.attributes);
            this.setDetailMode();
            this.setIsNotChanged();
        },

        delete: function () {
            if (confirm(this.translate('removeRecordConfirmation', 'messages'))) {
                this.trigger('before:delete');
                this.trigger('delete');

                this.notify('Removing...');

                var collection = this.model.collection;

                var self = this;
                this.model.destroy({
                    wait: true,
                    error: function () {
                        this.notify('Error occured!', 'error');
                    }.bind(this),
                    success: function () {
                        if (collection) {
                            if (collection.total > 0) {
                                collection.total--;
                            }
                        }

                        this.notify('Removed', 'success');
                        this.trigger('after:delete');
                        this.exit('delete');
                    }.bind(this),
                });
            }
        },

        getFieldViews: function (withHidden) {
            var fields = {};

            if (this.hasView('middle')) {
                if ('getFieldViews' in this.getView('middle')) {
                    _.extend(fields, Espo.Utils.clone(this.getView('middle').getFieldViews(withHidden)));
                }
            }
            if (this.hasView('side')) {
                if ('getFieldViews' in this.getView('side')) {
                    _.extend(fields, this.getView('side').getFieldViews(withHidden));
                }
            }
            if (this.hasView('bottom')) {
                if ('getFieldViews' in this.getView('bottom')) {
                    _.extend(fields, this.getView('bottom').getFieldViews(withHidden));
                }
            }
            return fields;
        },

        getFieldView: function (name) {
            var view;
            if (this.hasView('middle')) {
                view = (this.getView('middle').getFieldViews(true) || {})[name];
            }
            if (!view && this.hasView('side')) {
                view = (this.getView('side').getFieldViews(true) || {})[name];
            }
            if (!view && this.hasView('bottom')) {
                view = (this.getView('bottom').getFieldViews(true) || {})[name];
            }
            return view || null;
        },

        data: function () {
            var navigateButtonsEnabled = !this.navigateButtonsDisabled && !!this.model.collection;

            var previousButtonEnabled = false;
            var nextButtonEnabled = false;
            if (navigateButtonsEnabled) {
                if (this.indexOfRecord > 0) {
                    previousButtonEnabled = true;
                }

                if (this.indexOfRecord < this.model.collection.total - 1) {
                    nextButtonEnabled = true;
                } else {
                    if (this.model.collection.total === -1) {
                        nextButtonEnabled = true;
                    } else if (this.model.collection.total === -2) {
                        if (this.indexOfRecord < this.model.collection.length - 1) {
                            nextButtonEnabled = true;
                        }
                    }
                }

                if (!previousButtonEnabled && !nextButtonEnabled) {
                    navigateButtonsEnabled = false;
                }
            }

            return {
                scope: this.scope,
                entityType: this.entityType,
                buttonList: this.buttonList,
                buttonEditList: this.buttonEditList,
                dropdownItemList: this.dropdownItemList,
                dropdownEditItemList: this.dropdownEditItemList,
                dropdownItemListEmpty: this.isDropdownItemListEmpty(),
                buttonsTop: this.buttonsPosition === 'both' || this.buttonsPosition === true || this.buttonsPosition === 'top',
                buttonsBottom: this.buttonsPosition === 'both' || this.buttonsPosition === true || this.buttonsPosition === 'bottom',
                name: this.name,
                id: this.id,
                isWide: this.isWide,
                isSmall: this.type == 'editSmall' || this.type == 'detailSmall',
                navigateButtonsEnabled: navigateButtonsEnabled,
                previousButtonEnabled: previousButtonEnabled,
                nextButtonEnabled: nextButtonEnabled
            }
        },

        init: function () {
            this.entityType = this.model.name;
            this.scope = this.options.scope || this.entityType;

            this.layoutName = this.options.layoutName || this.layoutName;

            this.detailLayout = this.options.detailLayout || this.detailLayout;

            this.type = this.options.type || this.type;

            this.buttons = this.options.buttons || this.buttons;
            this.buttonList = this.options.buttonList || this.buttonList;
            this.dropdownItemList = this.options.dropdownItemList || this.dropdownItemList;

            this.buttonList = _.clone(this.buttonList);
            this.buttonEditList = _.clone(this.buttonEditList);
            this.dropdownItemList = _.clone(this.dropdownItemList);
            this.dropdownEditItemList = _.clone(this.dropdownEditItemList);

            this.returnUrl = this.options.returnUrl || this.returnUrl;
            this.returnDispatchParams = this.options.returnDispatchParams || this.returnDispatchParams;

            this.exit = this.options.exit || this.exit;
            this.columnCount = this.options.columnCount || this.columnCount;

            Bull.View.prototype.init.call(this);
        },

        isDropdownItemListEmpty: function () {
            if (this.dropdownItemList.length === 0) {
                return true;
            }

            var isEmpty = true;
            this.dropdownItemList.forEach(function (item) {
                if (!item.hidden) {
                    isEmpty = false;
                }
            }, this);

            return isEmpty;
        },

        setup: function () {
            if (typeof this.model === 'undefined') {
                throw new Error('Model has not been injected into record view.');
            }

            this.recordHelper = new ViewRecordHelper(this.defaultFieldStates, this.defaultFieldStates);

            var collection = this.model.collection;
            if (collection) {
                this.listenTo(this.model, 'destroy', function () {
                    collection.remove(this.model.id);
                    collection.trigger('sync');
                }, this);

                if ('indexOfRecord' in this.options) {
                    this.indexOfRecord = this.options.indexOfRecord;
                } else {
                    this.indexOfRecord = collection.indexOf(this.model);
                }
            }

            this.on('remove', function () {
                if (this.isChanged) {
                    this.model.set(this.attributes);
                }
                this.setIsNotChanged();
            }, this);

            this.numId = Math.floor((Math.random() * 10000) + 1);
            this.id = Espo.Utils.toDom(this.entityType) + '-' + Espo.Utils.toDom(this.type) + '-' + this.numId;

            if (_.isUndefined(this.events)) {
                this.events = {};
            }

            if (!this.editModeDisabled) {
                if ('editModeDisabled' in this.options) {
                    this.editModeDisabled = this.options.editModeDisabled;
                }
            }

            if ('buttonsPosition' in this.options) {
                this.buttonsPosition = this.options.buttonsPosition;
            }

            if ('isWide' in this.options) {
                this.isWide = this.options.isWide;
            }

            if ('sideView' in this.options) {
                this.sideView = this.options.sideView;
            }

            if ('bottomView' in this.options) {
                this.bottomView = this.options.bottomView;
            }

            this.readOnlyLocked = this.readOnly;
            this.readOnly = this.options.readOnly || this.readOnly;

            this.inlineEditDisabled = this.options.inlineEditDisabled || this.inlineEditDisabled;
            this.navigateButtonsDisabled = this.options.navigateButtonsDisabled || this.navigateButtonsDisabled;

            this.setupActionItems();

            this.setupFinal();

            this.on('after:render', function () {
                this.$detailButtonContainer = this.$el.find('.detail-button-container');
                this.$dropdownItemListButton = this.$detailButtonContainer.find('.dropdown-item-list-button');
            }, this);
        },

        setupFinal: function () {
            this.manageAccess();

            this.attributes = this.model.getClonedAttributes();

            if (this.options.attributes) {
                this.model.set(this.options.attributes);
            }

            this.listenTo(this.model, 'sync', function () {
                this.attributes = this.model.getClonedAttributes();
            }, this);

            this.listenTo(this.model, 'change', function () {
                if (this.mode == 'edit' || this.inlineEditModeIsOn) {
                    this.setIsChanged();
                }
            }, this);

            this.dependencyDefs = _.extend(this.getMetadata().get('clientDefs.' + this.model.name + '.formDependency') || {}, this.dependencyDefs);
            this.initDependancy();

            this.dynamicLogicDefs = _.extend(this.getMetadata().get('clientDefs.' + this.model.name + '.dynamicLogic') || {}, this.dynamicLogicDefs);
            this.initDynamicLogic();

            this.setupFieldLevelSecurity();
            this.build();
        },

        setIsChanged: function () {
            this.isChanged = true;
            this.setConfirmLeaveOut(true);
        },

        setIsNotChanged: function () {
            this.isChanged = false;
            this.setConfirmLeaveOut(false);
        },

        switchToModelByIndex: function (indexOfRecord) {
            if (!this.model.collection) return;
            var model = this.model.collection.at(indexOfRecord);
            if (!model) {
                throw new Error("Model is not found in collection by index.");
            }
            var id = model.id;

            var url;
            if (this.mode === 'edit') {
                url = '#' + this.scope + '/edit/' + id;
            } else {
                url = '#' + this.scope + '/view/' + id;
            }

            this.getRouter().navigate('#' + this.scope + '/view/' + id, {trigger: false});
            this.getRouter().dispatch(this.scope, 'view', {
                id: id,
                model: model,
                indexOfRecord: indexOfRecord
            });
        },

        actionPrevious: function () {
            if (!this.model.collection) return;
            if (!(this.indexOfRecord > 0)) return;

            var indexOfRecord = this.indexOfRecord - 1;
            this.switchToModelByIndex(indexOfRecord);
        },

        actionNext: function () {
            if (!this.model.collection) return;
            if (!(this.indexOfRecord < this.model.collection.total - 1) && this.model.collection.total >= 0) return;
            if (this.model.collection.total === -2 && this.indexOfRecord >= this.model.collection.length - 1) {
                return;
            }

            var collection = this.model.collection;

            var indexOfRecord = this.indexOfRecord + 1;
            if (indexOfRecord <= collection.length - 1) {
                this.switchToModelByIndex(indexOfRecord);
            } else {
                var initialCount = collection.length;

                this.listenToOnce(collection, 'sync', function () {
                    var model = collection.at(indexOfRecord);
                    this.switchToModelByIndex(indexOfRecord);
                }, this);
                collection.fetch({
                    more: true,
                    remove: false,
                });
            }
        },

        afterSave: function () {
            if (this.isNew) {
                this.notify('Created', 'success');
            } else {
                this.notify('Saved', 'success');
            }
            this.enableButtons();
            this.setIsNotChanged();
        },

        beforeSave: function () {
            this.notify('Saving...');
        },

        beforeBeforeSave: function () {
            this.disableButtons();
        },

        afterSaveError: function () {
            this.enableButtons();
        },

        afterNotModified: function () {
            var msg = this.translate('notModified', 'messages');
            Espo.Ui.warning(msg, 'warning');
            this.enableButtons();
        },

        afterNotValid: function () {
            this.notify('Not valid', 'error');
            this.enableButtons();
        },

        showDuplicate: function (duplicates) {
            this.notify(false);
            this.createView('duplicate', 'views/modals/duplicate', {
                scope: this.entityType,
                duplicates: duplicates,
            }, function (view) {
                view.render();

                this.listenToOnce(view, 'save', function () {
                    this.model.set('forceDuplicate', true);
                    this.actionSave();
                }.bind(this));

            }.bind(this));
        },

        setReadOnly: function () {
            if (!this.readOnlyLocked) {
                this.readOnly = true;
            }

            var bottomView = this.getView('bottom');
            if (bottomView && 'setReadOnly' in bottomView) {
                bottomView.setReadOnly();
            }

            var sideView = this.getView('side');
            if (sideView && 'setReadOnly' in sideView) {
                sideView.setReadOnly();
            }

            var fieldViews = this.getFieldViews();
            for (var i in fieldViews) {
                fieldViews[i].setReadOnly();
            }
        },

        setNotReadOnly: function () {
            if (!this.readOnlyLocked) {
                this.readOnly = false;
            }

            var bottomView = this.getView('bottom');
            if (bottomView && 'setNotReadOnly' in bottomView) {
                bottomView.setNotReadOnly();
            }

            var sideView = this.getView('side');
            if (sideView && 'setNotReadOnly' in sideView) {
                sideView.setNotReadOnly();
            }

            var fieldViews = this.getFieldViews();

            for (var i in fieldViews) {
                var fieldView = fieldViews[i];
                fieldView.setNotReadOnly();
            }
        },

        manageAccessEdit: function (second) {
            if (this.isNew) return;

            var editAccess = this.getAcl().checkModel(this.model, 'edit', true);

            if (!editAccess || this.readOnlyLocked) {
                this.readOnly = true;
                this.hideActionItem('edit');
                if (this.duplicateAction) {
                    this.hideActionItem('duplicate');
                }
            } else {
                this.showActionItem('edit');
                if (this.duplicateAction) {
                    this.showActionItem('duplicate');
                }
                if (!this.readOnlyLocked) {
                    if (this.readOnly && second) {
                        this.setNotReadOnly();
                    }
                    this.readOnly = false;
                }
            }

            if (editAccess === null) {
                this.listenToOnce(this.model, 'sync', function () {
                    this.manageAccessEdit(true);
                }, this);
            }
        },

        manageAccessDelete: function () {
            if (this.isNew) return;

            var deleteAccess = this.getAcl().checkModel(this.model, 'delete', true);

            if (!deleteAccess) {
                this.hideActionItem('delete');
            } else {
                this.showActionItem('delete');
            }

            if (deleteAccess === null) {
                this.listenToOnce(this.model, 'sync', function () {
                    this.manageAccessDelete();
                }, this);
            }
        },

        manageAccess: function () {
            this.manageAccessEdit();
            this.manageAccessDelete();
        },

        enableButtons: function () {
            this.$el.find(".button-container button").removeAttr('disabled');
        },

        disableButtons: function () {
            this.$el.find(".button-container button").attr('disabled', 'disabled');
        },

        removeButton: function (name) {
            for (var i in this.buttonList) {
                if (this.buttonList[i].name == name) {
                    this.buttonList.splice(i, 1);
                    break;
                }
            }
            for (var i in this.dropdownItemList) {
                if (this.dropdownItemList[i].name == name) {
                    this.dropdownItemList.splice(i, 1);
                    break;
                }
            }
            if (this.isRendered()) {
            	this.$el.find('.detail-button-container .action[data-action="'+name+'"]').remove();
            }
        },

        convertDetailLayout: function (simplifiedLayout) {
            var layout = [];

            var el = this.options.el || '#' + (this.id);

            for (var p in simplifiedLayout) {
                var panel = {};
                panel.label = simplifiedLayout[p].label || null;
                panel.name = simplifiedLayout[p].name || null;
                panel.style = simplifiedLayout[p].style || 'default';
                panel.rows = [];
                for (var i in simplifiedLayout[p].rows) {
                    var row = [];

                    for (var j in simplifiedLayout[p].rows[i]) {
                        var cellDefs = simplifiedLayout[p].rows[i][j];

                        if (cellDefs == false) {
                            row.push(false);
                            continue;
                        }

                        if (!cellDefs.name) {
                            continue;
                        }

                        var name = cellDefs.name;

                        var type = cellDefs.type || this.model.getFieldType(name) || 'base';
                        var viewName = cellDefs.view || this.model.getFieldParam(name, 'view') || this.getFieldManager().getViewName(type);

                        var o = {
                            el: el + ' .middle .field[data-name="' + name + '"]',
                            defs: {
                                name: name,
                                params: cellDefs.params || {}
                            },
                            mode: this.fieldsMode
                        };

                        if (this.readOnly) {
                            o.readOnly = true;
                        }

                        if (cellDefs.readOnly) {
                            o.readOnly = true;
                            o.readOnlyLocked = true;
                        }

                        if (this.readOnlyLocked) {
                            o.readOnlyLocked = true;
                        }

                        if (this.inlineEditDisabled || cellDefs.inlineEditDisabled) {
                            o.inlineEditDisabled = true;
                        }

                        var fullWidth = cellDefs.fullWidth || false;
                        if (!fullWidth) {
                            if (simplifiedLayout[p].rows[i].length == 1) {
                                fullWidth = true;
                            }
                        }

                        if (this.recordHelper.getFieldStateParam(name, 'hidden')) {
                            o.disabled = true;
                        }
                        if (this.recordHelper.getFieldStateParam(name, 'hiddenLocked')) {
                            o.disabledLocked = true;
                        }
                        if (this.recordHelper.getFieldStateParam(name, 'readOnly')) {
                            o.readOnly = true;
                        }
                        if (!o.readOnlyLocked && this.recordHelper.getFieldStateParam(name, 'readOnlyLocked')) {
                            o.readOnlyLocked = true;
                        }
                        if (this.recordHelper.getFieldStateParam(name, 'required') !== null) {
                            o.defs.params = o.defs.params || {};
                            o.defs.params.required = this.recordHelper.getFieldStateParam(name, 'required');
                        }
                        if (this.recordHelper.hasFieldOptionList(name)) {
                            o.customOptionList = this.recordHelper.getFieldOptionList(name);
                        }

                        var cell = {
                            name: name,
                            view: viewName,
                            el: el + ' .middle .field[data-name="' + name + '"]',
                            fullWidth: fullWidth,
                            options: o
                        };

                        if ('customLabel' in cellDefs) {
                            cell.customLabel = cellDefs.customLabel;
                        }
                        if ('customCode' in cellDefs) {
                            cell.customCode = cellDefs.customCode;
                        }

                        row.push(cell);
                    }

                    panel.rows.push(row);
                }
                layout.push(panel);
            }
            return layout
        },

        getGridLayout: function (callback) {
            if (this.gridLayout !== null) {
                callback(this.gridLayout);
                return;
            }

            if (this.detailLayout) {
                this.gridLayout = {
                    type: 'record',
                    layout: this.convertDetailLayout(this.detailLayout)
                };
                callback(this.gridLayout);
                return;
            }

            this._helper.layoutManager.get(this.model.name, this.layoutName, function (simpleLayout) {
                this.gridLayout = {
                    type: 'record',
                    layout: this.convertDetailLayout(simpleLayout)
                };
                callback(this.gridLayout);
            }.bind(this));
        },

        createSideView: function () {
            var el = this.options.el || '#' + (this.id);
            this.createView('side', this.sideView, {
                model: this.model,
                scope: this.scope,
                el: el + ' .side',
                type: this.type,
                readOnly: this.readOnly,
                inlineEditDisabled: this.inlineEditDisabled,
                recordHelper: this.recordHelper,
                recordViewObject: this
            });
        },

        createMiddleView: function (callback) {
            var el = this.options.el || '#' + (this.id);
            this.waitForView('middle');
            this.getGridLayout(function (layout) {
                this.createView('middle', this.middleView, {
                    model: this.model,
                    scope: this.scope,
                    type: this.type,
                    _layout: layout,
                    el: el + ' .middle',
                    layoutData: {
                        model: this.model,
                        columnCount: this.columnCount
                    },
                    recordHelper: this.recordHelper,
                    recordViewObject: this
                }, callback);
            }.bind(this));
        },

        createBottomView: function () {
            var el = this.options.el || '#' + (this.id);
            this.createView('bottom', this.bottomView, {
                model: this.model,
                scope: this.scope,
                el: el + ' .bottom',
                notToRender: true,
                readOnly: this.readOnly,
                type: this.type,
                inlineEditDisabled: this.inlineEditDisabled,
                recordHelper: this.recordHelper,
                recordViewObject: this
            }, function (view) {
                if (this.isRendered()) {
                    view.render();
                }
            }, this, false);
        },

        build: function (callback) {
            if (this.sideView) {
                this.createSideView();
            }

            if (this.middleView) {
                this.createMiddleView(callback);
            }

            if (this.bottomView) {
                this.once('after:render', function () {
                    this.createBottomView();
                }, this);
            }
        },


        /**
         * Called after save or cancel.
         * By default redirects page. Can be orverriden in options.
         * @param {String} after Name of action (save, cancel, etc.) after which #exit is invoked.
         */
        exit: function (after) {
            var url;
            if (this.returnUrl) {
                url = this.returnUrl;
            } else {
                if (after == 'delete') {
                    this.getRouter().dispatch(this.scope, null, {
                        isReturn: true
                    });
                    this.getRouter().navigate('#' + this.scope, {trigger: false});
                    return;
                }
                url = '#' + this.scope;
                if (this.model.id) {
                    url += '/view/' + this.model.id;
                }
            }

            if (this.returnDispatchParams) {
                var controller = this.returnDispatchParams.controller;
                var action = this.returnDispatchParams.action;
                var options = this.returnDispatchParams.options || {};
                this.getRouter().dispatch(controller, action, options);
                this.getRouter().navigate(url, {trigger: false});
                return;
            }

            this.getRouter().navigate(url, {trigger: true});
        }

    });

});

