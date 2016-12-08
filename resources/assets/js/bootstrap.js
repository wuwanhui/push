window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
var VueResource = require('vue-resource');
Vue.use(VueResource);
// var VueRouter = require('vue-router');
// Vue.use(VueRouter);
var Validator = require('vue-validator');
Vue.use(Validator);

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */
//
// Vue.http.interceptors.push(function (request, next) {
//     // ...
//     // 请求发送前的处理逻辑
//     layer.load();
//     request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
//     next(function (response) {
//         // ...
//         // 请求发送后的处理逻辑
//         // ...
//         // 根据请求的状态，response参数会返回给successCallback或errorCallback
//         if (!response.ok) {
//             layer.alert(response);
//         }
//         layer.closeAll('loading');
//         return response
//     })
// });

// Vue.http.interceptors.push((request, next) => {
//     // request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
//    // request.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
//     next();
// });

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
