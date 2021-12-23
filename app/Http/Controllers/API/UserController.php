<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ['message' => "I have your data"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function profile(Request $request)
    {
        return auth('api')->user();
    }
    public function updateProfile(Request $request)
    {   
        $user = auth('api')->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);
        $currentPhoto = $user->profile_picture;
       
        // dd($this->uploadImage($request, $user));
        
        if(!empty($request->password)){
            $request->merge(['password' => bcrypt($request['password'])]);
        }
        $user->update($request->all());
        return ['message' => "Success1"];
    }
    public function uploadImage($request, $user){

        $validationArray = [
            'profile_picture' => "mimes:jpeg,png|max:2048"
        ];
        $validator = Validator::make($request->all(), $validationArray);
        if ($validator->fails()) {
            return getValidationErrorJson($validator);
        }

        $disk = config('filesystems.default');
        if($request->file('profile_picture')){
        $file = $request->file('profile_picture');
        $name= time().$file->getClientOriginalName();
        $filePath = User::PUBLIC_IMAGES. "/".$user->id ."/".$name;
        $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
        if($file_store){
            $user->profile_picture = $name;
            $user->save();
            return response()->json(['success' => 1,"message" => "Profile Image Uploaded"]);
        }  

        }

    }
    

    public function destroy($id)
    {
        //
    }
}
