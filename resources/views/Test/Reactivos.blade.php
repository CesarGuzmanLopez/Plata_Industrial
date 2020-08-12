@extends('layouts.test')
@section('content')
<h2>Ingresa La pregunta</h2>
<div  class ="col-10" name="Pregunta" id="AdminReactivos">
	<editor name="tabla"  class="border" placeholder="Ingresa la pregunta" api-key='y384aesqbqgvxfvpzzc4i6h5sujdgwsxf4gf7uajcr2o2tkv' pla :init="{ 
                 	selector: 'div.tinymce',
                 toolbar: 'forecolor backcolor ',
                  menubar:true,
                  inline: true,
                  plugins: 'table image code',
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
                           failure('HTTP Error: ' + xhr.status);
                           return;
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
 }" />
</div>

@endsection