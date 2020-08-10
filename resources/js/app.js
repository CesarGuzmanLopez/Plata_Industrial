require('./bootstrap');
window.Vue = require('vue');

import 'jquery-ui/ui/widgets/datepicker.js';
import $ from 'jquery'; 
import BootstrapVue from 'bootstrap-vue' 

window.$ = window.jQuery = $;
global.$ = global.jQuery = require('jquery');
 window.Vue = require('vue');
require('./bootstrap');
//import * as uiv from 'uiv'
Vue.use(BootstrapVue); 

if($("#TemasAdd").length!=0)  
	new Vue({
	    el: '#TemasAdd',
	});

require('./Curso.js');
