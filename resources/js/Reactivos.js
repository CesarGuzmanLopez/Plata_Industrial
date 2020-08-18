if($("#AdminReactivos").length!=0) app = new Vue({
    el: '#AdminReactivos',
data() {
      	 return {
			Data :[],
		}
    },
   components: {
     'editor': Editor,
   },
  created: function () {
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


if($("#CrearReactivos").length!=0) app = 
new Vue({
  el: '#CrearReactivos',

data() {
      	 return {
			data:'',
			SelectCurso:0,
			ID_Grado:0,
			ID_Tema:0,
			ID_Tipo:0
		}
    },
   components: {
     'editor': Editor,
   },

	mounted: function (){
	//	/** @deprecated**/
		//debe estar activado js para que funcione los datos los scara del archivo
		//blade en el que se declara este archivo blade es
		//Reactivos/CrearReactivo
	//	this.data = DatosApp;
	//	console.log(this.data);
	},
	methods:{
		XMLHttpRequest(){
			return new XMLHttpRequest();
		},
		FormData(){
			return new FormData();
		},
		ChangeCurso(event) {
			var s=event.target.value;
		    console.log(event.target.value)
			axios.get( '/Reactivos/getGrado/'+s).then(
				response =>{
					if(response.data.ID_Grado){
						this.ID_Grado = response.data.ID_Grado;
						
					}else{
						
					}
					
				}
			);
		}
		
	}
});

