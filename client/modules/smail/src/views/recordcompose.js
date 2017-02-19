/**
 * Created by yav on 19.02.17.
 */

Espo.define('smail:views/recordcompose', ['views/record/edit', 'smail:views/recorddetail'], function (Dep, Detail) {

    return Dep.extend({

        isWide: true,

        sideView: false,

        setup: function () {
            Dep.prototype.setup.call(this);
        },

        send: function () {
            Detail.prototype.send.call(this);
        }

    });

});
