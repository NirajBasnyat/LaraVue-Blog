require("./bootstrap");

import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

//vuetify

window.Vue = require("vue");
Vue.use(Vuetify);
export default new Vuetify({});

//markdown editor

import VueSimplemde from "vue-simplemde";
import "simplemde/dist/simplemde.min.css";

import md from "marked";

window.md = md;

Vue.component("vue-simplemde", VueSimplemde);

//custom exports
import User from "./Helpers/User";
window.User = User;

import Exception from "./Helpers/Exception";
window.Exception = Exception;

window.EventBus = new Vue();

//Global Routes
Vue.component("app-home", require("./components/AppHome.vue").default);
import router from "./Router/router.js";

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    router
});
