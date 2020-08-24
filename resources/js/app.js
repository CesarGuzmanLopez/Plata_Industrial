import 'jquery-ui/ui/widgets/datepicker.js';
import BootstrapVue from 'bootstrap-vue' 
import 'mathjax/es5/tex-chtml-full';
import AOS from 'aos';


var Editor = require('@tinymce/tinymce-vue').default;
require('./bootstrap');
window.Vue = require('vue');

window.$ = window.jQuery = $; 	
global.$ = global.jQuery = require('jquery');
global.Editor = Editor;
global.AOS =window.AOS = AOS;
window.Editor=Editor;
window.Vue = require('vue');



Vue.use(global.Editor);
Vue.use(BootstrapVue);

require('./bootstrap');
require('tinymce');


require( 'venobox/venobox/venobox.min.js').default;
require( 'owl.carousel/dist/assets/owl.carousel.css').default;
require( 'owl.carousel').default;
require('aos').default;

Vue.component('tablamodelo', require('./components/TablaModelo.vue').default);
$(document).ready(function() {
require('./Princpal');
require('./Curso.js');
require('./Reactivos');
});

