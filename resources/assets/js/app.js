
require('./bootstrap');

window.Vue = require('vue');

Promise.delay = function (time) {
    return new Promise((resolve, reject) => {
        setTimeout(resolve, time)
    })
}

Promise.prototype.takeAtLeast = function (time) {
    return new Promise((resolve, reject) => {
        Promise.all([this, Promise.delay(time)]).then(([result]) => {
            resolve(result)
        }, reject)
    })
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('publish-button', require('./components/PublishButton.vue'));
Vue.component('subscribe-button', require('./components/SubscribeButton.vue'));
Vue.component('cover-image-upload', require('./components/CoverImageUpload.vue'));

const app = new Vue({
    el: '#app'
});
