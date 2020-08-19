import 'jquery-ui/ui/widgets/datepicker.js';
//import $ from 'jquery'; 
import BootstrapVue from 'bootstrap-vue' 
import Editor from '@tinymce/tinymce-vue';
import 'mathjax/es5/tex-chtml-full';
import AOS from 'aos';

require('./bootstrap');
window.Vue = require('vue');
Vue.use(Editor);
//require('tinymce');

window.$ = window.jQuery = $;
global.$ = global.jQuery = require('jquery');
global.Editor = Editor;

global.AOS =window.AOS = window.AOS = AOS;

window.Editor=Editor;
window.Vue = require('vue');

require('./bootstrap');
Vue.use(BootstrapVue); 

import VueAos from 'vue-aos'
Vue.use(VueAos);
require( 'isotope-layout');
require( 'venobox/venobox/venobox.min.js').default;
require(  'owl.carousel/dist/assets/owl.carousel.css').default;
require(  'owl.carousel').default;
require('aos').default;
import isotope from  'isotope-layout';

Vue.component('tablamodelo', require('./components/TablaModelo.vue').default);
$(document).ready(function() {
require('./Princpal');
require('./Curso.js');
require('./Reactivos');
});

