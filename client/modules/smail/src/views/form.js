/**
 * Created by yav on 19.02.17.
 */

Espo.define('smails:views/form', 'views/detail', function (Dep) {

    return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);
            if (!~['Sended', 'Canceled'].indexOf(this.model.get('status'))) {
                if (this.getAcl().checkModel(this.model, 'edit')) {
                    this.menu.buttons.push({
                        'label': 'Sended',
                        'action': 'setSended',
                        'iconHtml': '<span class="glyphicon glyphicon-ok"></span>',
                        'acl': 'edit',
                    });
                }
                this.listenToOnce(this.model, 'sync', function () {
                    if (~['Sended', 'Canceled'].indexOf(this.model.get('status'))) {
                        this.$el.find('[data-action="setSended"]').remove();
                    }
                }, this);
            }
        },

        actionSetCompleted: function (data) {
            var id = data.id;

            this.model.save({
                status: 'Sended successfully'
            }, {
                patch: true,
                success: function () {
                    Espo.Ui.success(this.translate('Sended'));
                    this.$el.find('[data-action="setSended"]').remove();
                }.bind(this),
            });

        },

        send: function () {
            var model = this.model;
            model.set('status', 'Sending');

            var afterSend = function () {
                Espo.Ui.success(this.translate('emailSent', 'messages', 'Email'));
                this.trigger('after:send');
            };

            this.once('after:save', afterSend, this);
            this.once('cancel:save', function () {
                this.off('after:save', afterSend);
            }, this);

            this.once('before:save', function () {
                Espo.Ui.notify(this.translate('Sending...', 'labels', 'Email'));
            }, this);

            this.save();
        },

    });

});
