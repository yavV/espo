/**
 * Created by yav on 19.02.17.
 */

Espo.define('smail:views/recorddetail', 'views/record/detail', function (Dep) {

    return Dep.extend({

        //sideView: 'views/email/record/detail-side',

        duplicateAction: false,

        init: function () {
            Dep.prototype.init.call(this);

        },

        setup: function () {
            Dep.prototype.setup.call(this);

        },



        afterRender: function () {
            Dep.prototype.afterRender.call(this);


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

