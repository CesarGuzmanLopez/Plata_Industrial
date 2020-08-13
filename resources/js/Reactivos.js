if($("#AdminReactivos").length!=0) app = new Vue({
    el: '#AdminReactivos',
data() {
      	 return {
      	 formula: '$$x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}.$$',
 
		}
    },
   components: {
     'editor': Editor,

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