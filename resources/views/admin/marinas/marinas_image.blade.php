<h1 class="page-header">
  Marina Images
</h1>

@include('admin.marinas.marinas_tab')

<!-- begin panel -->
<style type="text/css">
  .nav-tabs a.active{
    background: #fff;
  }
</style>

<div class="panel panel-inverse" style="padding-bottom:1000px;">
  <div class="panel-body">
  
   @include('admin.marinas.shared.image_form')
 </div>
</div>
<script>
   function loadProfilePreview(input, id) {
    id = id || '#profile_preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    
                    
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }
 function loadBackgroundPreview(input, id) {
    id = id || '#background_preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }
</script>




