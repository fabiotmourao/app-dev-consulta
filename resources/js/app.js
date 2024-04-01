import './bootstrap';

import { createApp } from 'vue';

import Home from './layouts/Home.vue';

import router from './routes/router.js';

import VueTheMask from 'vue-the-mask';


const app = createApp(Home);

app.use(VueTheMask);

app.use(router);

app.mount('#app');
