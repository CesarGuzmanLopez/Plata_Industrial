require('./bootstrap');
window.Vue = require('vue');







import 'jquery-ui/ui/widgets/datepicker.js';
import $ from 'jquery'; 
import BootstrapVue from 'bootstrap-vue' 
import Editor from '@tinymce/tinymce-vue';
Vue.use(Editor);
window.$ = window.jQuery = $;
global.$ = global.jQuery = require('jquery');
global.Editor = Editor;
window.Editor=Editor;


 window.Vue = require('vue');
require('./bootstrap');

Vue.use(BootstrapVue); 


require('./Curso.js');
require('./Reactivos');
