if($("#AdminReactivos").length!=0) app = new Vue({
    el: '#AdminReactivos',
data() {
      	 return {

      	 }
    },
   components: {
     'editor': Editor
   },
	methods:{
		XMLHttpRequest(){
			return new XMLHttpRequest();
		},
		FormData(){
			return new FormData();
		}
	}
});