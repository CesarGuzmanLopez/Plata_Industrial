	<editor name="{{$name}}" id="{{$name}}" value="{{$value??(old($name)??'')}}"   class="border" placeholder="Ingresa {{$name}}" api-key='y384aesqbqgvxfvpzzc4i6h5sujdgwsxf4gf7uajcr2o2tkv' pla :init="{ 
                 	selector: 'div.tinymce',
                    external_plugins: {
                    		'mathjax': '/js/plugins/tinymce-mathjax/plugin.min.js',
          					'tiny_mce_wiris': 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js' 
                    },
                 	mathjax: {
                        lib: '/js/mathjax/es5/tex-mml-chtml.js', 
                      },
                    toolbar: 'forecolor backcolor charmap insert hr mathjax  tiny_mce_wiris_formulaEditorChemistry',
                    menubar: 'edit insert view format table tools wordcount ' ,
                  	inline: true,
				
                  	plugins: 'table image code advlist directionality charmap template wordcount  mathjax  autoresize hr' ,
                  	branding: false,
              
                  	images_upload_url: '{{route('Reactivos/subirImagen')}}',
               	 	images_upload_handler: function (blobInfo, success, failure) {
                   	var xhr, formData;
                   	xhr =  XMLHttpRequest();
                   	xhr.withCredentials = false;
                   	xhr.open('POST', '{{route('Reactivos/subirImagen')}}');
                   	var token = '{{ csrf_token() }}';
                   	xhr.setRequestHeader('X-CSRF-Token', token);
                   	xhr.onload = function() {
                       var json;
                       if (xhr.status != 200) {
                           failure('HTTP Error: ' + xhr.status); return;
                       }
                       json = JSON.parse(xhr.responseText);
        
                       if (!json || typeof json.location != 'string') {
                           failure('Invalid JSON: ' + xhr.responseText);
                           return;
                       }
                       success(json.location);
                   };
                   formData =  FormData();
                   formData.append('file', blobInfo.blob(), blobInfo.filename());
                   xhr.send(formData);
               }      
 }" ></editor>