require('./bootstrap');

window.Vue = require('vue');

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

var app = new Vue({
    el: '#app',
    data: {
    message: 'Hello Vue.js!'
  }
});
