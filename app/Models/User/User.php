<?php

namespace App\Models\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\UserDetail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens ,HasFactory, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public const DEFAULT_IMAGES = "default/user.png";
    public const IMAGES = "uploads/user_profile";
    public const PUBLIC_IMAGES = "public/" . (self::IMAGES);
    public const DOCUMENTS = "uploads/documents";
    public const PUBLIC_DOCUMENTS = "public/" . (self::DOCUMENTS);
    public const LICENSE = "uploads/boat_license";
    public const PUBLIC_LICENSE = "public/" . (self::LICENSE);

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'country_code',
        'mobile',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getAllUserTypes(){
        return $types = [0 => "User", 1 => "Rental Operator"];
    }
    public function getMobileStrAttribute(){
        return phoneNumberToString($this->mobile);
    }
 
    public function getUserType(){
        $types = self::getAllUserTypes();
        if(isset($types[$this->user_type])){
            return $types[$this->user_type];
        }
    }

     public function detail()
    {
        return $this->hasOne(UserDetail::class, "user_id", "id")->withDefault([
           
            "goverment_document_id" => "",
            "goverment_document" => "",
            "boat_license_document" => "",
            "emergency_contact" => "",
            "company_name" => "",
            "street" => "",
            "city" => "",
            "state" => "",
            "zipcode" => "",
            "about_me" => "",
        ]);
    }
    public function getFullNameAttribute(){

        return $this->first_name." ". $this->last_name;
    }
}
