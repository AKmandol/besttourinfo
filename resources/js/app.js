require('./bootstrap');

import { createApp } from 'vue'
import { BootstrapIconsPlugin } from 'bootstrap-icons-vue'

import common from './common.js'
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'

import VCalendar from 'v-calendar';
import 'v-calendar/dist/style.css';

//import CKEditor from '@ckeditor/ckeditor5-vue';

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import router from './router';
import mainapp from './components/master.vue'
import admin from './components/adminMaster.vue'

import store from './store.js'

const app = createApp({
    components: {
        mainapp,
        admin
    }
})
.mixin(common);
app.component('QuillEditor', QuillEditor)
app.use(store);
app.use(router);
app.use(ViewUIPlus);
app.use(VCalendar, {});
app.use(BootstrapIconsPlugin);
app.mount('#app');
