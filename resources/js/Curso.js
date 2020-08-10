if($("#TemasLista").length!=0) app = new Vue({
    el: '#TemasLista',
	data() {
      	 return {
      		 	DATO:"asdf",
      		 	Ver_noticias:true,
      		 	windowWidth :0,
				Temas :[],
				NuevoNombre:"",
      	 }
    },
	 mounted() {
		axios.get('/CrearCurso/GetTemas').then((response) =>{
        	this.Temas  =response.data;
        }); 
	},
	methods:{
		AddTema(){
			var formData = new FormData();
			formData.append('_method','PUT');
			formData.append('NombreTema',this.NuevoNombre);
			axios.post( '/CrearCurso/AddTemaS',formData
           ).then(response =>{
				if(response)
				axios.get('/CrearCurso/GetTemas').then((response) =>{
        			this.Temas  =response.data;
       			 }); 
			});
		}
	}

});