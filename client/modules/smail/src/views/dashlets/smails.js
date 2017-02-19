/**
 * Created by yav on 19.02.17.
 */
Espo.define('smail:views/dashlets/smails', 'views/dashlets/abstract/record-list', function (Dep) {

    return Dep.extend({
        init: function () {
            var attributes = this.getCreateAttributes() || {};

            this.notify('Loading...');
            var viewName = this.getMetadata().get('clientDefs.' + this.scope + '.modalViews.compose') || 'smail:views/compose';
            this.createView('modal', viewName, {
                scope: this.scope,
                attributes: attributes,
            }, function (view) {
                view.render();
                view.notify(false);
                this.listenToOnce(view, 'after:save', function () {
                    this.actionRefresh();
                }, this);
            }, this);
        }

    });
});