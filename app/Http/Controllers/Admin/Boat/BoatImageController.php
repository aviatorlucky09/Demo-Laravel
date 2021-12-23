<?php

namespace App\Http\Controllers\Admin\Boat;

use App\Models\Boat\BoatImage;
use App\Models\Boat\Boat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config;
use View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BoatImageController extends Controller
{
   public function __construct()
   {
        $this->middleware('auth:admin');
    }
    public function boat_image($boat_id)
    {
        $boat = Boat::where('id',$boat_id)->first();
        $active_tab = "image";
        if(!$boat){
            return view('error.page_not_found');
        }
        //$images = $boat->images;
        $images = BoatImage::where('boat_id',$boat_id)->orderBy('position','asc')->get();

        return view('admin.boats.image',compact("boat","active_tab","images"));

    }
    public function boat_image_store(Request $request,$boat_id){

    $v_arr =  array();

    $v_arr['file'] ="required|mimes:jpeg,jpg,png";

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {
        return response()->json(getValidationErrorJson($v));
        exit;
    }

   $boat_image = new BoatImage();
   $boat_image->boat_id = $boat_id;
   $disk = config('filesystems.default');

    if($request->file('file')){
        $file = $request->file('file');
        $name= time().$file->getClientOriginalName();
        $filePath = BoatImage::BOAT_IMAGES. "/".$boat_id ."/".$name;
           
        $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
        if($file_store){
            $boat_image->image = $name;
            $boat_image->is_crop = 0;
            $boat_image->save();
        }

    }
    $url="";
    $result_array = array( 'result' => "success",'message' => "Boat Images Uploaded Successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;

    }

    public function boat_image_grid(Request $request,$boat_id){

     $boat = Boat::find($boat_id);
     if(!$boat){
        return view('error.page_not_found');
    }
    $images = BoatImage::where('boat_id',$boat_id)->orderBy('position','asc')->get();
    //$images = $boat->images;
    return view('admin.boats.shared.image_grid',compact("boat","images"));
    }

    public function boat_image_delete(Request $request,$boat_id,$image_id){
     $image = BoatImage::where('id',$image_id)->where("boat_id", $boat_id)->first();
     if($image){
         $image->delete();
     }

     $url="";
     $result_array = array( 'result' => "success",'message' => "Boat Image Deleted Successfully" , 'url' => $url);
     return response()->json($result_array);
     exit;
    }

    public function boat_image_status_store(Request $request,$boat_id,$image_id){

      $boat_image =  BoatImage::where('id',$image_id)->where("boat_id", $boat_id)->first();

       if($request->status == 0){
          $boat_image->status = 0;
       }else{
         $boat_image->status = 1;
       }
       $boat_image->save();
       $url="";
       $result_array = array( 'result' => "success",'message' => "Boat Image Status Updated Successfully" , 'url' => $url);
       return response()->json($result_array);
       exit;

    }

    public function boat_image_position_update(Request $request,$boat_id){

      //dd($request->all());
      $pos_arr = $request->pos_arr;
      unset($pos_arr[0]);

      foreach($pos_arr as $image_id=>$position){

        $boat_image = BoatImage::where('id',$image_id)->where('boat_id',$boat_id)->first();
        $boat_image->position = $position;
        $boat_image->save();

      }
      $url="";
       $result_array = array( 'result' => "success",'message' => "Boat Image Position Updated Successfully" , 'url' => $url);
       return response()->json($result_array);
       exit;


    }

}
