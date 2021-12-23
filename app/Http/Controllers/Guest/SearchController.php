<?php

namespace App\Http\Controllers\Guest;

use App\Models\Company\RentalOperatorInquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Auth;
use Validator;

class SearchController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
       
       return view('guest.search.search');
    }
    

}
