<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\User;

class RentalOperatorInquiry extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['contact_number_str'];

    public static function statusList(){
        $arr  = array();
        $arr['in-review'] = ['label' => 'In Review', 'color'=>''];
        $arr['pending']   = ['label' => 'Pending',   'color'=>''];
        $arr['approved']  = ['label' => 'Approved',  'color'=>''];
        $arr['declined']  = ['label' => 'Declined',  'color'=>''];
        return $arr;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function  getActionHistoryArrayAttribute(){
        if(isJson($this->action_history)){
           $arr = json_decode($this->action_history, true);
           if(is_array($arr)){
               return $arr;
           }
        }
        return array();
    }
    public function getContactNumberStrAttribute(){
        return phoneNumberToString($this->contact_number);
    }

    public function createHistory($by,$note){
       $historyArr = $this->action_history_array;
       $newArr = array('by'=> $by,'status'=>$this->status,'note'=> $note,'date'=> currentDateTime());
       array_unshift($historyArr , $newArr);
       $this->action_history = json_encode($historyArr);
       $this->save();
       
    }

}
