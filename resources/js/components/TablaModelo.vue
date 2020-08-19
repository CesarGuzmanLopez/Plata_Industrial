<template>
   <b-container fluid class="col-12 "> 
   <div class="row text_font">   
   <div class="col-12 pt-4  px-0   pr-md-0 col-md-8 pt-md-0 pl-md-4 ">
   <div class="bg-white  flex-column " >
     <div class="row p-4">
     <div class="col-12 col-md-5">	
       <div class="row">
       <div class="col-8 p-0">
	      <b-form-input
	        class=""
	        v-model="filter"
	        type="search"
	        id="filterInput"
	        placeholder=""
	      ></b-form-input>  
	     </div>
	     <div class="col-4 " >
	      <b-button class="" :disabled="!filter" @click="filter = ''"> Clear </b-button>
	      </div>
 	   </div>
 	  </div>

     </div>
     <b-table
      id="moleculesTableShowDB"
      show-empty
      small
       responsive="sm"
      striped 
       hover 
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
      :busy="isBusy"
      fixed
      noCollapse 
      outlined 
    >
    <template v-slot:table-busy>
        <div class="text-center text-dark my-2">
          <b-spinner small label="align-middle" variant="dark"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
    
      <template v-slot:cell(Name)="row" >
       <div @click="Selected(row)"> {{ row.value }} </div>
      </template>
      <template v-slot:cell(SMILE)="row" >
       <div @click="Selected(row)"> {{ row.value }} </div>
      </template>
      <template v-slot:cell(pKa_K_Overall)="row">
        <div @click="Selected(row)">
        <b-button size="sm"  class="fa   fa-save bg-info mr-1"  @click="(row.item)"> <span class="text-white"> Save info </span></b-button>
        <b-button size="sm"  class="fa fa-paper-plane mr-1" href="#info" @click="(row.item)"> <span class="text-white"> go </span></b-button>
     </div>
      </template>
      <template v-slot:cell(Valor)="row"> 
         <div @click="Selected(row)"> {{row.Value}}</div>
      </template>
      <template v-slot:cell(ris_image)="row">
         <div @click="Selected(row)">
        <b-button size="sm" @click="row.toggleDetails" class="fa fa-file-text ">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} RIS
        </b-button>
         </div>
      </template>
      <template v-slot:row-details="row">
       <div @click="Selected(row)">
        <b-card >
         <div v-if="row.item.Reference != null && row.item.Reference != 'null'">
             <b-form-textarea
               rows="6"
               max-rows="10"
               :value='row.item.Reference'
             ></b-form-textarea>
         </div>
         <div v-else-if="row.item.RIS != null">
             <b-form-textarea
               rows="6"
               max-rows="10"
               :value='row.item.RIS'
             ></b-form-textarea>
         </div>
        </b-card>
        </div>
      </template>
    </b-table>
    <b-col sm="7" md="12" class="my-1">
      <b-pagination
       v-model="currentPage"
       :total-rows="totalRows"
       :per-page="perPage"
       align="fill"
       size="sm"
       class="my-0"
      ></b-pagination>
      <br/> 
    </b-col>
    </div>
    </div>
    </div>
    <div class="row " id="info">
    <transition name="fade">
         <div v-if="pKa_s.length>0" class="col-12 p-0 m-md-0 col-md-6 pr-md-4 ">
            <div id="PKA_S" class="pt-4  mt-4 contentDATA">
               <h3><b>Molar Fractions </b>  <span class="float-right"> {{selected.Name}}</span></h3>  
             <div class="col-12">
                  <div v-for="(item, index) in pKa_s" >
                   <div v-if="index == 0 ||item.Tipo_Exp_teo !=pKa_s[index-1].Tipo_Exp_teo ">
                        <div  class="col-12 sub"  >
                           <div  v-if="item.Tipo_Exp_teo =='E' " >
                             <b>Experimental</b>
                           </div>
                           <div v-if="item.Tipo_Exp_teo =='T' " >
                             <b>Theoretical</b>  
                           </div> 
                        </div>            
                   </div> 
                    <div class="row "> 
                       <div class="col-1"></div>
                       <div class="col-4"> <b>pKa{{index+1}}:  <span class="pl-3">{{item.Value}}</span> </b></div>
                       <div class="col-3"  v-if="item.Site !='' && item.Site!=null"  data-toggle="tooltip" title="Site for image">Site: {{item.Site}}</div>
                       <div class="col-4" v-if="item.Description !='' && item.Description!=null"  data-toggle="tooltip" title="description regarding this value"><div>Description:</div> {{item.Description}}</div>           
                     
                     </div>
                  </div>
                
                </div>
             </div>
         </div>
        </transition>
         
     <transition name="fade">
         <div v-if="K_Overals.length>0" class="col-12 col-md-6  pt-0 px-0">
            <div id="K_Ov" class=" pt-4 mt-4 contentDATA">
                <h3><b>Kinetics constants K<sub>overalls</sub></b> <span class="float-right"> {{selected.Name}}</span></h3> 
                <div class="col-12"> 
               <div class="row">
               	<div class="col-12 col-md-9">
                  <div v-for="item in K_Overals"> 
                    <div class="row py-1"  >
                       <span  ><span><b> Solvent:</b> {{item.Name_Solvent}} </span><span> <b> Radical:</b> {{item.Name_Radical}} </span><span> <b>pH: </b> {{item.pH}}</span>  <span data-toggle="tooltip"  :title="item.Valor.toFixed(0)"><b>K<sub>overall: </sub></b> {{item.Valor.toPrecision(2)}}</span> <span><b>Details: </b>{{item.Descripcion}} </span>  </span>
                    </div>                     
                  </div>
                  
                 </div>
                 <div class="col-0 col-md-3">
                         <b-button href="/Kinetics/relative-k-overall" variant="outline-primary">Relative K Overall</b-button>
                 
                 </div>
                </div>
               </div>
            </div>
         </div>
      </transition> 
      
     <transition name="fade">
       <div v-if="pKa_s.length>0" class="col-12 p-0 "> 
         <div  class="col-12 col-md-12 bg-white mt-4 p-0  ">
         <div class="row p-0 m-0 pt-4  mt-4 contentDATA ">
           <div class="col-12"> 
             <h3><b>Molar Fractions Graphic</b>  <span class="float-right"> {{selected.Name}}</span></h3>  
           </div>
            <div class="col-12 col-md-5 p-0 pl-4  pt-4" >
     			<div class="row m-0 p-0">
     				<div class="col-12"><h4>pH range</h4></div>
                	<div class="col-3"><b>Min:</b> <b-form-input  v-model="pH_Range.Min" >Min</b-form-input></div> 
                	<div class="col-3"><b>Max:</b> <b-form-input  v-model="pH_Range.Max">Max</b-form-input> </div>
                	<div class="col-3"><b>Step:</b> <b-form-input  v-model="pH_Range.Step">Step</b-form-input> </div>
                	<!-- b-form-input   class="col-2 " id="pH_graph" v-model="pH_F_Gr"  @input="cargagraph" @change="cargagraph" ></b-form-input>
                	<div class="col-12" > 
                	</div-->
          		</div>
          		<div class="row ">
          		<div class="col-12 py-4">
	          		<template v-if="!(parseFloat(pH_Range.Step) <.0009 || parseFloat(pH_Range.Min)<0 || parseFloat(pH_Range.Max)>14)">
	                	<table border="1" class="table"> 
	                		<thead>
	                		<tr>
	                			<th>ph</th>
	                			<th v-for=" a in range(0,valores.length,1)">f{{a}}</th>
	                		</tr>
	                		</thead>
	                		<tbody>
	                		<tr v-for="a in range(parseFloat(pH_Range.Min),parseFloat(pH_Range.Max)+parseFloat(pH_Range.Step),parseFloat(pH_Range.Step))">
	                			<td>{{a.toFixed(2)}}</td>
	                			<td v-for=" j in range(0,valores.length,1)" :class="colors[j]+' text-white'">
	                				{{FK(a,j).toFixed(4)}}
	                			</td>
	                	 	</tr>    		
	                	 </tbody>
	                	 </table>
                	 </template>                	
          		</div>
          		</div>
           </div>
           <div class="col-12 col-md-7 p-4 pr-5">
           	<div class="colores row">
           		 
  				<div  v-for="(item,index) in labelEtic" class="col-3 p-0 pl-1">
  					<div class="row">
					<div  :class="item[1]+ ' col-3 '"> </div> <div class="col-5">{{ item[0] }}</div>
					</div>
                </div>	
           	</div> 
            <div class="ct-chart ct-golden-section " id="Uncn1" ></div>
           </div> 
         </div>
         </div>
         </div>
      </transition>  
     </div>
   </b-container>  
</template> 
<script>

var y;

export default {//vue  
	data(){
		return {
			
    	    tipo_pK:"",
    	  	tipo_kO:"",
    	    /*grafica */
    	    pH_F_Gr:7.4,
    	  	pKa_s_Gr: [], 
    	  	/*fin grafica*/
    	  	Fractions:	[],
    	  	inx:		0,
    	  	selected:	{},
    	  	isBusy: 	true,
    	  	items:		[],
    	  	colors:	[],
    	  	labelEtic:[],
    	  	totalRows:	0,
    	    totalRows: 	1,
            currentPage: 1,
            perPage: 8,
            pageOptions: [5, 10, 15],
            sortBy: '',
            sortDesc: false,
            sortDirection: 'asc',
            filter: null,
            filterOn:[],
            valores:[],
            pKa_s: [],
            K_Overals: [],
            data_K_Overalls: [],
            data_pKa_s: [],
			pH_Range:{
				Min:7.4,
				Max:7.4,
    	  		Step:1,
			},
			pH_default:{
				Min:7.4,
				Max:7.4,
    	  		Step:1,
			},
            fields: [

          	],
        }  
    },
    computed:{
    	sortOptions() { 
    		return this.fields.filter(f => f.sortable).map(
    		f => {return { text: f.label, value: f.key }})
    	},
    	
    },
    mounted() {
    	// Set the initial number of items
        this.totalRows = this.items.length
        axios.get('/Reactivos/getReactivos').then(response =>{
        	this.items = response.data;
            this.isBusy= false;
            this.totalRows = this.items.length; 
        }); 
    },
    methods: { 
    	onFiltered( filteredItems) {
        	this.totalRows = filteredItems.length
          	this.currentPage = 1
        },
        cambiatipo_pk(valor){
        	this.tipo_pK=valor;
        },
        /*Grafica  */
        fBeta( k){
        	var suma=0.0;
        	if(k>this.pKa_s_Gr.length)
        		throw ("k mayor que pk_a");
        	for(var i=0; i<k ; i++ ){ 
         		suma += this.pKa_s_Gr[(this.pKa_s_Gr.length)-i-1];
        	}
         	return 10**suma;
        },
        F0( V_pH){
        	var suma=1.0;
        	var Con_H = 10 ** (-V_pH);
        	for(var i=0; i<this.pKa_s_Gr.length;i++ ){
        		suma += this.fBeta(i+1)*Con_H**(i+1)	
        	}
        	return 1/suma;
        },
        FK( V_pH, K){
        	if(K==0)
        		return this.F0(V_pH);
        	var Con_H = 10 ** (-V_pH); 
        	return this.F0(V_pH)*this.fBeta(K)*Con_H**K;
        },
        reverse(value) {
  		  // slice to make a copy of array, then reverse the copy
  		  return value.slice().reverse();
  		},
        cargagraph(){
        	this.pH_Range=this.pH_default;
			var pH=this.pH_F_Gr;
         	var Serie =[];
         	var xs=[]; this.pKa_s_Gr=[];
         	for(var j=0; j< this.pKa_s.length;j++){ 
         		this.pKa_s_Gr.push(this.pKa_s[j].Value);
        	}
         	var eti=['A', 'HA','H2A','H3A'];
         	this.Fractions=[];
         	this.labelEtic =[];
         	this.valores=[];
         	for(var j=0; j<=this.pKa_s_Gr.length;j++ ){
        		var Valores=[];
        		//console.log(this.pKa_s_Gr); 
        		for(var i=0.1; i<=14; i+=.1){
 					var d=this.FK(i,j);
 					Valores.push(d);
        		}
        	//	this.Fractions.push(this.FK(this.pH_F_Gr,j));
        		this.labelEtic.push([eti[j],this.colors[j]]);
        		Serie.push(
        			{"name":eti[j], 
        			 type: 'line',
                     label: "2017",
                     backgroundColor: 'rgba(151,249,190,0.5)',
                     borderColor: 'rgba(151,249,190,1)',
                     borderWidth: 1,
                     "data": Valores.slice()}); 
        		this.valores.push(Valores.slice());
         	} 
         	var temp=[];
        	for(var i=0.0; i<=14; i+=.1){
    			xs.push(i);
        	}      
        	this.labelEtic =this.labelEtic.reverse();
        	//setTimeut Grafica
        	setTimeout((x)=>{
        		var unc = new Chartist.Line('#Uncn1', 
        		{
        			labels: xs,
       		    	series: Serie,
        		},
        		{
        			fullwidth: true,
       		    	chartPadding: {
       			  		right: 40,
       		  		},
          		 	showPoint: false,
          		  	axisX: { 
          		    	labelInterpolationFnc: function(value, index) {
          		      		var A=  index% 20 === 0 ? index/10 : null;
          		    	 
          		    	    return A;
          		    	}
          		  	},
        		});
        		
        		unc.on('draw', function(data){
        	  		if(data.type === 'line' || data.type === 'area') {
        		    	data.element.animate({
              		      	d:{
              		        	begin: 100 * data.index,
              		        	dur: 100,
              		        	from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
              		        	to: data.path.clone().stringify(),
              		        	easing: Chartist.Svg.Easing.easeOutQuint
              		      	}
        		    	});
        		  	}
        		});
        		
        		
        	} ,100);
        	//fin setTimeut Grafica
        },
        range (start, stop, step = 1) {
        	
        	if(start==stop)return [start];
        //	console.log( Array(Math.ceil((stop - start) / step)).fill(start).map((x, y) => x + y * step));
        	return Array(Math.ceil((stop - start) / step)).fill(start).map((x, y) => x + y * step);
        },
        /*fin grafica*/
        Selected(index){
        	//contador para los indices
        	this.tipo_pK="";
    	  	this.tipo_kO="";
         	//Primero camio la imagen
        	this.selected.img="files/data-base-img/"+index.item.ID+ "/"+index.item.Imagen;;
       		this.selected.Name=index.item.Name; 
       		var getData=false;
       		for (var i = 0; i < this.data_pKa_s.length; i+=1) {
       			if(this.data_pKa_s[i].id==index.item.ID ){
       				this.pKa_s=[];
       				this.K_Overals=[];    
       			  	this.pKa_s=this.data_pKa_s[i].data;
       			  	this.K_Overals=this.data_K_Overalls[i].data;
       				getData=true;
       				this.cargagraph();
       		  	} 
       		}
       		if(!getData){
       			//despues seleciono unos pka especificos 
            	axios.get( 'PK_S/'+index.item.ID 
            	).then(response =>{ 
            		this.pKa_s = response.data;
           	    	this.data_pKa_s.push({id:index.item.ID ,data:JSON.parse(JSON.stringify(response.data))});
   
           	    	this.cargagraph();
            	});  
       		
     	   		//despues seleccino unos KOverals
            	axios.get( 'KOverals/'+index.item.ID 
            	).then(response =>{ 
           	    	this.K_Overals = response.data; 
           			this.data_K_Overalls.push({id:index.item.ID ,data:  JSON.parse(JSON.stringify(response.data))});
           			this.cargagraph();
             	}); 
       		}
        },
    }

}

</script>
<style>
    .tama{
      min-height: 100px;
    }
    .Wcol{
      max-width: 3px;
    }
    .infoCol{ 
    }
    .as{ 
      padding: 0px !important;
      padding-left:20px !important;
    }
    .trans{  
    }
    .contentDATA{
      background-color:  #ffffff !important;
      min-height: 100px;
      padding: 10px;
      border-radius: 0px 40px 0px 10px !important;
      
    }
    .contentDATA h3{
      display:inline-block;
      width: 100%;
      border-bottom: 4px solid blue;
    }
    .fade-enter-active, .fade-leave-active {
      transition: all .5s ease-in;
      opacity: 100;
      -webkit-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1);
      -moz-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      -ms-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      -o-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1);
   }
   .fade-enter, .fade-leave-to {
      opacity: 0;
      -webkit-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      -moz-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      -ms-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      -o-transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      transition: all 0.5s cubic-bezier(1, -0.5, 0.5, 1); 
      height:0px;
   } 
   .text_font{
      font-size: .75rem !important;
   }
   .img_max{ 
   }
   .img_molecule{
      max-height: 340px;
   }
   .sub{
      font-size: 20px;
   }
   #BaseDatos {
      min-height: 100px;
      padding: 30px;
      margin-bottom: 30px;
   }
   .ct-axis-titley{
      font-size: 20px !important;
      transform: rotate(-90deg);
      background-color: red !important;
      -webkit-transform: rotate(-90deg); 
      -moz-transform: rotate(-90deg);
      -ms-transform: rotate(-90deg); 
      -o-transform: rotate(-90deg);
   }
   .ct-axis-titlex{
      font-size: 20px !important;
   }
 
   .color1{
	   background-color: #453d3f;
   }
   .color2{
	   background-color: #6188e2; 
   }	

   .color3{
   	   background-color: #86797d;
   }	

   .color4{
   	   background-color: #6b0392;
   }	

   .color5{
   	   background-color: #0544d3;
   }

</style>
