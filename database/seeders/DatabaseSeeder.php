<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User\User;
use App\Models\Company\Company;
use App\Models\User\Admin;
use App\Models\User\AdminRole;
use Illuminate\Support\Facades\Hash;
use App\Models\System\AppConfig;
use App\Models\System\AppLanguage;
use Illuminate\Support\Facades\Storage;
use App\Models\System\State;
use App\Models\System\Country;
use App\Models\System\City;
use DB;
use App\Models\Boat\Boat;
use App\Models\Boat\BoatType;
use App\Models\Boat\BoatManufacturer;
use App\Models\Boat\BoatAmenity;
use App\Models\Marina\Marina;
use App\Models\Marina\MarinaAmenity;
use App\Models\Boat\BodyOfWater;

use App\Models\System\Policy\CancellationPolicyData;
use App\Models\System\Policy\FuelPolicyData;
use App\Models\System\Policy\WeatherPolicyData;

use App\Models\HomePage\HomeTestimonial;
use App\Models\HomePage\HomeDestination;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 

        $role = AdminRole::find(1);
        if(!$role){
            $role = new AdminRole();
            $role->name = "Admin";
            $role->save();
        }


        $admin = Admin::find(1);
        if(!$admin){
            $admin = new Admin();
            $admin->role_id = $role->id;
            $admin->first_name = "admin";
            $admin->last_name = "admin";
            $admin->email ="admin@gmail.com";
            $admin->password = bcrypt('tester123');
            $admin->save();
        }

        $company = Company::find(1);
        if(!$company){
            $company = new Company();
            $company->user_id = 1;
            $company->name = "ABC Comapny";
            $company->address ="Rajkot";
            $company->save();
        }


        $user = User::find(1);
        if(!$user){
            $user = new User();
            $user->company_id = 1;
            $user->first_name = "Admin";
            $user->last_name = "Admin";
            $user->email = "admin@gmail.com";
            $user->password = bcrypt('tester123');
            $user->save();


        }

        // website name
        $config = AppConfig::where("config_key","website_name")->first();
        if(!$config){
            $config  = new AppConfig();
            $config->config_key = "website_name";
            $config->config_name = "Website Name";
            $config->data_type = "string";
            $config->category = "website";
            $config->data_value = "New Wave Harbor";
            $config->save();
        }

        // favicon
        $config = AppConfig::where("config_key","favicon")->first();
        if(!$config){
            $config  = new AppConfig();
            $config->config_key = "favicon";
            $config->config_name = "Favicon Icon";
            $config->data_type = "image";
            $config->category = "website";
            $config->data_value = "";
            $config->save();
        }

        
        if(!Country::find(1)){
            $country = new Country();
            $country->name = "USA";
            $country->save();
        }
        $seedFilePath  = 'public/db_seed/';
        if(State::all()->count() == 0){
             if (Storage::disk('local')->exists($seedFilePath.'states.sql')) {
                 $contents = Storage::disk('local')->get('public/db_seed/states.sql');
                 DB::statement($contents);
             }
            if(City::all()->count() == 0){
                if (Storage::disk('local')->exists($seedFilePath.'states.sql')) {
                    $contents = Storage::disk('local')->get('public/db_seed/states.sql');
                    DB::statement($contents);
                }
            }
        }

        /******* Create policy data ***/
        $allowPolicies = CancellationPolicyData::CANCELLATION_POLICIES;
        foreach ($allowPolicies as  $_policy) {
        	$policyRow = CancellationPolicyData::where('policy_type',$_policy)->first();
            if(!$policyRow){
                $policyRow = new CancellationPolicyData();
                $policyRow->policy_type     =  $_policy;
                $policyRow->save();
                if($_policy == "strict"){
                	$policyRow = new CancellationPolicyData();
					$policyRow->policy_type     =  $_policy;
                	$policyRow->save();
                }
        	}
        }

        $allowPolicies = WeatherPolicyData::WEATHER_POLICIES_TYPE;

        foreach ($allowPolicies as  $_policy) {
            $policyRow = WeatherPolicyData::where('policy_type',$_policy)->first();
            if(!$policyRow){
                $policyRow = new WeatherPolicyData();
                $policyRow->policy_type     =  $_policy;
                $policyRow->save();
            }
        }

        $allowPolicies = FuelPolicyData::FUEL_POLICIES;
        foreach ($allowPolicies as  $_policy) {
            $policyRow = FuelPolicyData::where('policy_type',$_policy)->first();
            if(!$policyRow){
                $policyRow = new FuelPolicyData();
                $policyRow->policy_type     =  $_policy;
                $policyRow->save();
            }
        }


        /********** For Testing  ***/
        //  if(!City::find(1)){
        //     $city = new City();
        //     $city->country_id = 1;
        //     $city->state_id = 1;
        //     $city->name = 1;
        //     $sort_order = 0;
        //     $city->save();
        // }
      $boatTypes   = array();
      $boatTypes[] = "jet skis";
      $boatTypes[] = "Pontoon Rentals";
      $boatTypes[] = "Sailboat Rentals";
      $boatTypes[] = "Wakeboard Rentals";
      $boatTypes[] = "Dinghy Rentals"; 
      $boatTypes[] = "Catamaran Rentals"; 
      $boatTypes[] = "Kayak Rental"; 
      $boatTypes[] = "Paddle Board Rentals"; 
      foreach($boatTypes as $key =>$bType){

        $boatType                       = new BoatType();
        $boatType->name                 = $bType;
        $boatType->display_on_homepage  = 1;
        $boatType->save();
      }

       for($i=1; $i<=4; $i++){

        $boatManufacturer = new BoatManufacturer();
        $boatManufacturer->name = "boat_manufacturer_".$i;
        $boatManufacturer->save();
      }
      for($i=1; $i<=4; $i++){

        $boatAmenitiy = new BoatAmenity();
        $boatAmenitiy->name = "boat_amenity_".$i;
        $boatAmenitiy->sort_order = $i;
        $boatAmenitiy->save();
      }
       for($i=1; $i<=4; $i++){
        $bodyOfWater = new BodyOfWater();
        $bodyOfWater->name = "body_of_water_".$i;
        $bodyOfWater->sort_order = $i;
        $bodyOfWater->save();
      }
      $marina = Marina::find(1);
        if(!$marina){
            $marina = new Marina();
            $marina->company_id = 1;
            $marina->body_of_water_id = 1;
            $marina->name = "marina_1";
            $marina->save();

        }
       $boat = Boat::find(1);
        if(!$boat){
            $boat = new Boat();
            $boat->company_id = 1;
            $boat->boat_type_id = 1;
            $boat->marina_id = 1;
            $boat->name = "boat_1";
            $boat->listing_title = "boat_1_listing_title";
            $boat->description = "boat_1_description";
            $boat->save();

        }
        for($i=1; $i<=4; $i++){
        $marinaAmenity = new MarinaAmenity();
        $marinaAmenity->name = "marina_amenity".$i;
        $marinaAmenity->sort_order = $i;
        $marinaAmenity->save();
      }
        $size = HomeTestimonial::count();
        if($size == 0){
            for($i = 0; $i<5;$i++){
                $testimonial = new HomeTestimonial();
                $testimonial->full_name = "Andy Dimasky";
                $testimonial->designation = "Marina Owner";
                $testimonial->description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempore incidunt ut labore et dolore magna aliqua. Ut enime ad minime veniam, nostrud exercitation is ullamco laboris nisi ut aliquip ex ea commodo consequat. ";
                $testimonial->via = "Facebook";
                $testimonial->image = "public/images/users/profile-1.png";
                $testimonial->save();

            }
        }

        $size = HomeDestination::count();
        if($size == 0){
            $city = array();
            $city[] = "New York City";
            $city[] = "Austin";
            $city[] = "San Diego";
            $city[] = "Las Vegas";
            $city[] = "Charlotte";

            for($i = 0; $i<5;$i++){
                $destination =  new HomeDestination();
                $destination->title =  $city[$i] ;
                $destination->description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempore incidunt ut labore et dolore";
                $destination->image = "";
                $destination->save();

            }
        }
        \Artisan::call('db:seed', [
            'class' => 'LanguageSeeder'
        ]);
    }
}
