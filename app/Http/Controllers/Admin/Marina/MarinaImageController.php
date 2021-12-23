<?php
namespace App\Http\Controllers\Admin\Marina;

use App\Models\Marina\MarinaImage;
use App\Models\Marina\Marina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MarinaImageController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth:admin');
 }
 public function marina_image($marina_id)
 {
    $marina = Marina::where('id',$marina_id)->first();
    $active_tab = "image";
    if(!$marina){
        return view('error.page_not_found');
    }

    //$images = $marina->images;
    $images = MarinaImage::where('marina_id',$marina_id)->orderBy('position','asc')->get(); 

    return view('admin.marinas.marinas_image',compact("marina","active_tab","images"));     

}
public function marina_image_store(Request $request,$marina_id){
    
    $v_arr =  array();
    $v_arr['file'] ="required|mimes:jpeg,jpg,png";

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    } 

    $marina_image = new MarinaImage();
    $marina_image->marina_id = $marina_id;
    $disk = config('filesystems.default');

    if($request->file('file')){
           $file = $request->file('file');
           $name= time().$file->getClientOriginalName();
           $filePath = MarinaImage::MARINA_IMAGES. "/".$marina_id ."/".$name;
           $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
                if($file_store){
                    $marina_image->image = $name;
                    $marina_image->is_crop = 0;
                    $marina_image->save();
                }  

         }
   
 
    $url="";
    $result_array = array( 'result' => "success",'message' => "Marina Images Uploaded Successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;
}

public function marina_image_grid(Request $request,$marina_id){

   $marina = Marina::find($marina_id);
   if(!$marina){
    return view('error.page_not_found');
} 
$images = MarinaImage::where('marina_id',$marina_id)->orderBy('position','asc')->get();
//$images = $marina->images;
return view('admin.marinas.shared.image_grid',compact("marina","images"));  
}

public function marina_image_delete(Request $request,$marina_id,$image_id){

   MarinaImage::where('id',$image_id)->where("marina_id", $marina_id)->delete();
   $url="";
   $result_array = array( 'result' => "success",'message' => "Marina Image Deleted Successfully" , 'url' => $url);
   return response()->json($result_array);
   exit;
}

public function marina_image_status_store(Request $request,$marina_id,$image_id){

  $marina_image =  MarinaImage::where('id',$image_id)->where("marina_id", $marina_id)->first();

   if($request->status == 0){
      $marina_image->status = 0;
   }else{
     $marina_image->status = 1;
   }
   $marina_image->save();
   $url="";
   $result_array = array( 'result' => "success",'message' => "Marina Image Status Updated Successfully" , 'url' => $url);
   return response()->json($result_array);
   exit;
   
}

public function marina_image_position_update(Request $request,$marina_id){

  //dd($request->all());
  $pos_arr = $request->pos_arr;
  unset($pos_arr[0]);
  foreach($pos_arr as $image_id=>$position){

    $marina_image = MarinaImage::where('id',$image_id)->where('marina_id',$marina_id)->first();
    $marina_image->position = $position;
    $marina_image->save();

  }
  $url="";
   $result_array = array( 'result' => "success",'message' => "Marina Image Position Updated Successfully" , 'url' => $url);
   return response()->json($result_array);
   exit;


}
   




}
