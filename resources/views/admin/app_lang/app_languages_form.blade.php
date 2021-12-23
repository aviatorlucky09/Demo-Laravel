 @php
 	
 	$list_url = ajaxUrl(route('admin.app_langs',['page'=>$obj->page]));
 	$update_url = route($carr['update_route_name'],['id' => $obj->id]);

 @endphp

 <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item"><a href="{{ $list_url }}" data-toggle="ajax"> {{ $carr['plural_name'] }}</a></li>
   
    <li class="breadcrumb-item"> Edit </li>
     
</ol> 
<h1 class="page-header">
   Edit   {{ $carr['singular_name'] }} : {{ $obj->lang_name }}
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
                              <label class="col-form-label"> {{ $obj->lang_name }}   </label>
                                <input name="data_value" type="text"  class="form-control m-b-5" value="{{ $obj->data_value }}" />
                               
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
 
 
  
 

     