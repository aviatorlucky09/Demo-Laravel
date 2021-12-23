<?php

namespace App\Http\Controllers\Guest;

use App\Models\Company\RentalOperatorInquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Auth;
use Validator;

class OperatorInquiryController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
       $inquiry = RentalOperatorInquiry::where("user_id",-1)->first();
       if(\Auth::guard('web')->check()){
           $inqiery = RentalOperatorInquiry::where("user_id",\Auth::user()->id)->first();
       }
       if(!$inquiry){
           $inquiry = new RentalOperatorInquiry();
       }
       return view('guest.operator-inquiry.inquiry-form',compact('inquiry'));
    }
    public function update(Request $request)
    {

        $request->merge(['contact_number' =>  trim(phoneNumberStringToNumber( $request->contact_number))]);
        
        $validationArray    =[
            'email_id'           => 'required',
            'contact_number'     => 'required|digits:10',
            'address'            => 'required',
            'company_name'       => 'required',
            'about_company'      => 'required',
        ];

        $validator = Validator::make($request->all(), $validationArray);
        if ($validator->fails()) {
          return  getValidationErrorJson($validator);
        }

        /***** Cech email id stored in Inquery database ****/
        $inqiery = RentalOperatorInquiry::where("email_id",$request->email_id)->first();
        if($inqiery){
            $data = array();
            $data['result'] = "error";
            $data['message'] = "your inquiry already submitted.";
            return response()->json($data);
        }


        
        $inqiery = RentalOperatorInquiry::where("user_id",-1)->first();
        if(\Auth::guard('web')->check()){
            $inqiery = RentalOperatorInquiry::where("user_id",\Auth::user()->id)->first();
        }
        
        if(!$inqiery){
            $inqiery = new RentalOperatorInquiry();
            if(\Auth::guard('web')->check()){
                $inqiery->user_id = Auth::user()->id;
            }
        }
        $inqiery->email_id          = $request->email_id;
        $inqiery->contact_number    = $request->contact_number;
        $inqiery->address           = $request->address;
        $inqiery->about_company     = $request->about_company;
        $inqiery->company_name      = $request->company_name;
        $inqiery->status            = 'in-review';
        $inqiery->latitude          = $request->latitude;
        $inqiery->longitude         = $request->longitude;
        
        $inqiery->save();

        $data = array();
        $data['result'] = "success";
        $data['message'] = "Inquiry submited";
        $data['callback'] = "reloadPage";
        return response()->json($data);

    }

}
