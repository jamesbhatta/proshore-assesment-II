require("./bootstrap");
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
// import store from "./store";
import Notifications from '@kyvg/vue3-notification';

axios.defaults.withCredentials = true;

const app = createApp(App);

app
// .use(store)
.use(router).use(Notifications).mount("#app");

// Setup NProgress
import NProgress from "nprogress";
import 'nprogress/nprogress.css'
NProgress.configure({ showSpinner: false });
router.beforeResolve((to, from, next) => {
    if (to.path) {
        NProgress.start();
    }
    next();
});

router.afterEach(() => {
    NProgress.done();
});

// Global Components
import LoadingBars from './components/LoadingBars.vue';
app.component('loading-bars', LoadingBars);
import ProcessingButton from './components/ProcessingButton.vue';
app.component('processing-button', ProcessingButton);

