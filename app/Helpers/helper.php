<?php 
use App\Models\System\Country;
use App\Models\System\State;
use App\Models\Marina\Marina;
use App\Models\System\GovernmentDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\System\ChangeLog;
use Illuminate\Support\Facades\Storage;

function getCacheValue($key)
{
  return Cache::store('file')->get($key);
}
function _assets($url, $assets = "assets/")
{
    return asset($assets . $url);
}
function upload_image_url($url)
{
    if(empty($url)){return "";}
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    }

    // $image =_assets(Storage::url($url), "");

    return _assets(Storage::url($url), "");
}

function is_dev_mode(){
  return config('app.dev_mode');
}
function phoneNumberToString($number){
  $result = "";
  if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $number,  $matches ) )
  {
    $result = "(".$matches[1] . ') ' .$matches[2] . '-' . $matches[3];
  }
  return $result;
}
function phoneNumberStringToNumber($string){
  return preg_replace("/[^0-9]/", "", $string );
}
function currentDateTime(){
  $dt = new DateTime();
  return $dt->format('Y-m-d H:i:s');
}
function dateToStringTime($dateTime){
  return date("d-m-Y H:i:s",strtotime($dateTime));   
}


function getAppConfig($key, $default=''){

  if (Cache::store('file')->has('app_config_'.$key)) {
    return Cache::store('file')->get('app_config_'.$key);
  }

  return $default;
  
}

function ajaxUrl($url){
	$base_url = URL::to('/');
	$tmp = str_replace($base_url,"",$url);
	$tmp = trim($tmp,"/");
  return "#".$tmp;  
}

function visibleDateFormat($date,$format="d-m-Y"){
  if(strtotime($date) > 10000){
    return date($format,strtotime($date));
  }
  return "";
}
function dateFormatWithDay($date){
  if(strtotime($date) > 10000){
    return date("m-d-Y (l)",strtotime($date));
  }
  return "";
}
function isJson($string) {
  json_decode($string);
  return (json_last_error() == JSON_ERROR_NONE);
}

function getAdminViewFolderPath($carr , $string){

  return  $carr['view_folder'].".".$carr['table_name']. $string;
}
function getValidationErrorJson($v){
  $html = '';
  $error = array();
  $e = $v->messages();
  foreach ($v->messages()->getMessages() as $key => $errors){
    foreach($errors as $error){
      $html .= $error."<br>";
    }
  }
  $error_message = $html;
  $result_array = array('success'=>0 ,'result' => "error",'message' => $error_message,'error_list' => $e);

  return $result_array;
}

function getDateRangeArrayFromStr($str , $days = 7){

  if(empty($str)){
    $to_date = date("Y-m-d");
    $from_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($to_date)) . " -".$days." day"));
    return getDatesFromRange($from_date , $to_date);
  }

  //  get 2 dates from date

  $str_arr = explode(" - ", $str);
  if(sizeof($str_arr) == 2){

    if(strtotime($str_arr[0]) > 1000 and strtotime($str_arr[1]) > 10000)
    {

      $from_date = date("Y-m-d",strtotime($str_arr[0]));
      $to_date =  date("Y-m-d",strtotime($str_arr[1]));

      if(dateDiffInDays($from_date,$to_date) <= 365){
        return getDatesFromRange($from_date , $to_date);
      }
    }

  }
  return array();
}
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
  $array = array();
  $interval = new DateInterval('P1D');

  $realEnd = new DateTime($end);
  $realEnd->add($interval);

  $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

  foreach($period as $date) { 
    $array[] = $date->format($format); 
  }

  return $array;
}
function dateDiffInDays($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
  $diff = strtotime($date2) - strtotime($date1); 

    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
  return abs(round($diff / 86400)); 
}
function getCountries(){
  return Country::all();
}
function getStates($country_id){
  return State::where("country_id", $country_id)->get(); 
}
function getAllStates(){
 return State::all();
}
function getCountryCodes(){

  $arr = array();
  $arr["1"] = "+1";
  $arr["91"] = "+91";

  return $arr;

}
function telephoneNumberFormat($number){
  if(empty($number)){
    return "";
  }

  return sprintf("(%s) %s-%s",
    substr($number, 0, 3),
    substr($number, 3, 3),
    substr($number, 6));
}



function getYearRangeForBoat(){
 $starting_year = 2000; 
 $latest_year = date('Y'); 
 $arr = array();
 foreach ( range( $starting_year,$latest_year ) as $i ) {
    $arr[] =  $i;
  }
  return $arr;
}
function getBoatPriceValue($prices, $day, $key)
{
    //$days = ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"];
    //$day = $days[$day];

    $return = null;
    foreach ($prices as $i => $val) {
        if ($val["day"] === $day) {
            return  $val[$key];
        }
    }
}
function getWeekDaysArray(){

  $arr = array();

  $arr["MON"] = "Monday";
  $arr["TUE"] = "Tuesday";
  $arr["WED"] = "Wednesday";
  $arr["THU"] = "Thursday";
  $arr["FRI"] = "Friday";
  $arr["SAT"] = "Saturday";
  $arr["SUN"] = "Sunday";

  return $arr;
  
}

function getBoatDayPartsArray(){
   $arr = array();

  $arr["half_day_am"] = "Half Day AM";
  $arr["half_day_pm"] = "Half Day PM";
  $arr["full_day"] = "Full Day";
  $arr["hourly"] = "Hourly";
 

  return $arr;
 
}

function getAllGenderTypes(){
  $gender = array();
  $gender['male'] = "Male";
  $gender['female'] = "Female";

  return $gender;
}

function getAdminMarinaPriceValue($prices,$type_id,$field_name){
    foreach ($prices as $i => $val){
      if($val["fees_type_id"] === $type_id){
        return  $val[$field_name];
      }
        
    }
}

function getMarinaStatus(){

  return $arr = ["pending" => "Pending","approved" => "Approved","declined"=>"Declined"];

}
function getMarinaName($marina_id = 0){

   $marina = Marina::where('id',$marina_id)->first();
   if(!$marina){
    return "";
   }
   return $marina->name;

}

function getBoatStatus(){

  return $arr = ["pending" => "Pending","approved" => "Approved","declined"=>"Declined","draft"=>"Draft"];

}

function getAllGovtDocuments(){
 $docs = GovernmentDocument::all();
 $arr = array();
 foreach($docs as $doc){
  $arr[$doc->id] = $doc->name;

}
return $arr;
}

function getRentalOperatorStatus(){

 return $arr = ["pending" => "Pending","approved" => "Approved","declined"=>"Declined"];

}

function getUserImagepath(){

  $user = Auth::user();
  return 'storage/uploads/user_profile/'.$user->id."/".$user->profile_picture;
  

}
function updateModelChangeLog($model , $flag = "updated"){
    
 
    if(!Auth::check()){
        return;
    }

    if(!empty($flag) and ($flag == "created" or $flag == "deleted")){
        $log = new ChangeLog();
        if(Auth::guard('web')->check()){
            $log->user_id       = Auth::guard('web')->user()->id;    
        }
        if(Auth::guard('admin')->check()){
            $log->admin_id       = Auth::guard('admin')->user()->id;    
        }
        
        $log->class_name    = class_basename($model);
        $log->class_id      = $model->id;
        $log->field_name    = "";
        $log->old_value     = "";
        $log->new_vale      = "";
        $log->flag          =$flag;
        $log->save();

        return;
    }

    $original = $model->getOriginal();
    $dirty = $model->getDirty();
    if(sizeof($dirty)){
        foreach ($dirty as $key => $_dirty) {
            if($key == "updated_at"){
                continue;
            }

            if(!isset($original[$key])){
                continue;
            }

            $log = new ChangeLog();
           if(Auth::guard('web')->check()){
             $log->user_id       = Auth::guard('web')->user()->id;    
            }
            if(Auth::guard('admin')->check()){
                $log->admin_id       = Auth::guard('admin')->user()->id;    
            }
            $log->class_name = class_basename($model);
            $log->class_id = $model->id;
            $log->field_name = $key;
            $log->old_value = $original[$key];
            $log->new_vale = $_dirty;
            $log->flag=$flag;
            $log->save();
        }
     }
} 

function getHoursArrayForPolicy(){
   $arr = array();
  for($i=1; $i<=6; $i++){
    $arr[] = $i;
  }
  return $arr;
}






