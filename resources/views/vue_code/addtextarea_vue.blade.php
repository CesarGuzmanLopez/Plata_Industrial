<?php if(isset($value)){ $value=htmlentities ($value,ENT_QUOTES); $value=preg_replace("/[\r\n|\n|\r]+/", "", $value); } 
$id=str_replace(']','_',str_replace('[', '_', $name));
?>
<noscript>
<p>Es obligatorio el uso de Java script </p>
</noscript>
	<editor name="{{$name}}" id="{{$id}}" value='{!! $value??(old($name)??"")  !!}'   class="border" placeholder="Ingresa {{$name}}" api-key='y384aesqbqgvxfvpzzc4i6h5sujdgwsxf4gf7uajcr2o2tkv' pla :init="{ 
                 	selector: '#{{$id}}',
                    external_plugins: {
                    		'mathjax': '/js/plugins/tinymce-mathjax/plugin.js',
          					'tiny_mce_wiris': 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js' 
                    },
                    mathjax: {
                       lib: '/js/app.js', 
                    },
                    menubar: 'edit insert code view format table toc tools wordcount insert ' ,
                  	inline: true,
                  	tabfocus_elements: ':prev,:next',
				       toolbar: 'forecolor backcolor code charmap visualblocks insert hr tabfocus toc media numlist bullist importcss emoticons preview mathjax  tiny_mce_wiris_formulaEditorChemistry',
                  	plugins: 'table image  code visualblocks codesample advlist directionality  tabfocus media lists imagetools  emoticons autolink  charmap preview template wordcount  mathjax  autoresize hr' ,
                  	branding: false,
               		  entity_encoding : 'raw',
                      add_unload_trigger : false,
                      remove_linebreaks : false,
                      apply_source_formatting : false,
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