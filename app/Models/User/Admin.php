<?php


namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getFullNameAttribute(){
        return $this->first_name." ".$this->last_name;
    }



    public function createdByUser()
    {
        return $this->belongsTo(Admin::class, "created_by")->withDefault(function () {
            return new Admin();
        });
    }
    public function role()
    {
        return $this->belongsTo(AdminRole::class, "role_id")->withDefault(function () {
            return new role();
        });
    }
    public  function permissionArr(){
        $permissionArr = json_decode($this->permission,1);
        if(is_array($permissionArr)){
            return $permissionArr;
        }
        return array();
    }
    public  function permissionNameArr() : array{
        $array = array();
        foreach ($this->permissionArr() as $module => $option){
            if(is_array($option)){
                foreach ($option as $okey => $val){
                    if($val){
                        $array[$module."_".$okey] = 1;
                    }
                }
            }
        }
        return $array;
    }
    /**** Combine permission with role permission ****/
    public  function permissionWithRoleNameArr(): array
    {
        $array = $this->permissionNameArr();
        if($this->role->id){
            $array = array_merge($array ,$this->role->permissionNameArr());
        }
        return $array;
    }
    public  function hasAccess($accessName)
    {
        /**** consider id 1 is super admin no need any permission ****/
        if($this->id == 1){
            return 1;
        }
        
        $permissionArr = $this->permissionWithRoleNameArr();
        if(!empty($accessName) and isset($permissionArr[$accessName]) and $permissionArr[$accessName] == 1){
            return 1;
        }
        return 0;
    }
    public  function hasAccessByArray($accessName = array())
    {
        foreach ($accessName as $name){
            $f = $this->hasAccess($name);
            if($f){
                return 1;
            }
        }
        return 0;

    }


}
