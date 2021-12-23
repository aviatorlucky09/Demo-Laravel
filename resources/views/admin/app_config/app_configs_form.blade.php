 @php
 	 
 	$list_url = ajaxUrl(route('admin.app_configs',['category'=>$obj->category]));
 	$update_url = route($carr['update_route_name'],['id' => $obj->id]);


 @endphp

 <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item"><a href="{{ $list_url }}" data-toggle="ajax"> {{ $carr['plural_name'] }}</a></li>
   
    <li class="breadcrumb-item"> Edit </li>
     
</ol> 
<h1 class="page-header">
   Edit   {{ $carr['singular_name'] }} : {{ $obj->config_name }}
</h1>
 
<!-- begin panel -->
<div class="panel panel-inverse">
    <div class="panel-body">
        <form id='form_user' 
              action="{{ $update_url }}" 
              method="post" 
              onsubmit="return submitForm(this)" 
              enctype="multipart/form-data">
            <input name="{{ $carr['table_name'] }}_id" type="hidden" value="{{ $obj->id }}">
                    @csrf
                    <div class="row  justify-content-md-center">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                              <label class="col-form-label"> {{ $obj->config_name }}   </label>
                              @if($obj->data_type == "yes_no")  
                                <select name="data_value"  class="form-control m-b-5">
                                  <option value="yes">Yes</option>
                                  <option value="no" @if($obj->data_value == "no") selected @endif >No</option>
                                </select>
                                
                              @elseif($obj->data_type == "float")
                              select_data
                                <input name="data_value" type="number" step="0.01"  class="form-control m-b-5" value="{{ $obj->data_value }}" />
                              @elseif($obj->data_type == "select")
                                <select name="data_value" class="form-control">
                                    @foreach($obj->get_select_data() as $h => $hourt)
                                      <option value="{{ $h }}" @if($obj->data_value == $h ) selected @endif >{{ $hourt }}</option>
                                    @endforeach
                                </select>
                              @elseif($obj->data_type == "image")
                                <div class=" row">
                                  <div class="col-md-6">
                                     <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="customFile" name="file" 
                                      onchange="loadProfilePreview(this)">
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    @php
                                      $path =   upload_image_url($obj->data_value ); 
                                    @endphp
                                    <img id="profile_preview" src="{{ url($path) }}" class="img-responsive" style="width:100%" />
                                  </div>
                                </div>
                              @else
                                <input name="data_value" type="text"  class="form-control m-b-5" value="{{ $obj->data_value }}" />
                              @endif  
                            </div>
                            <div class="col-md-6">
                               
                            </div>
                            
                        </div>
                         
                    </div>
                     
                    <br>
                    <br>
                    <div class="row">
                         <br>
                          <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <a href="{{ $list_url  }}" data-toggle="ajax" class="btn btn-warning start m-r-5 pull-right" > Back </a>
                            <input type="submit" class="btn btn-success start m-r-5 pull-right" value="@if($obj->id == 0) Create   @else  Update   @endif ">
                        </div>
                         
                    </div>
                     
                   </form>
    </div>
</div>
 
 
  
 

     