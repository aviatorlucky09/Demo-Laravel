<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppConfigController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CountryController;
/********* Boats ****/
use App\Http\Controllers\Admin\Boat\BoatTypeController;
use App\Http\Controllers\Admin\Boat\BoatManufacturerController;
use App\Http\Controllers\Admin\Boat\BoatAmenityController;
use App\Http\Controllers\Admin\Boat\BoatController;
use App\Http\Controllers\Admin\Boat\BoatImageController;
use App\Http\Controllers\Admin\Boat\BoatDescriptionController;
use App\Http\Controllers\Admin\Boat\BoatPriceController;
use App\Http\Controllers\Admin\Boat\BoatChangeLogController;
/********* Marina ****/
use App\Http\Controllers\Admin\Marina\MarinaAmenityController;
use App\Http\Controllers\Admin\Marina\MarinaController;
use App\Http\Controllers\Admin\Marina\MarinaDescriptionController;
use App\Http\Controllers\Admin\Marina\MarinaImageController;
use App\Http\Controllers\Admin\Marina\MarinaOwnerController;
use App\Http\Controllers\Admin\Marina\BodyOfWaterController;
/******* FAQ */
use App\Http\Controllers\Admin\Faq\FaqCategoryController;
use App\Http\Controllers\Admin\Faq\FaqDetailController;
/******* Blog */
use App\Http\Controllers\Admin\Blog\BlogCategoryController;
use App\Http\Controllers\Admin\Blog\BlogDetailController;
/******* User */
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\AdminController;
use App\Http\Controllers\Admin\User\AdminRoleController;
use App\Http\Controllers\Admin\User\UserDetailController;
use App\Http\Controllers\Admin\User\OperatorInquiryController;
use App\Http\Controllers\Admin\User\CompanyController;
use App\Http\Controllers\Admin\User\CompanyChangeLogController;
/***** Settings ****/
use App\Http\Controllers\Admin\Setting\WeatherPolicyController as SettingWeatherPolicy;
use App\Http\Controllers\Admin\Setting\FuelPolicyController as SettingFuelPolicy;
use App\Http\Controllers\Admin\Setting\CancellationPolicyController as SettingCancellationPolicy;

use App\Http\Controllers\Admin\GovernmentDocumentController;
use App\Http\Controllers\Admin\ChangeLogController;
use App\Http\Controllers\Admin\CancellationPolicyDataController;
use App\Http\Controllers\Admin\WeatherPolicyDataController;
use App\Http\Controllers\Admin\FuelPolicyDataController;
use App\Http\Controllers\Admin\DepositeReasonController;

use App\Http\Controllers\Admin\AppLanguageController;




Route::group(['prefix'=>'nwh-master','as'=>'admin.'], function(){

  /*********** custome command  help to admin ***** */
  Route::get('/command/{name}',[App\Http\Controllers\Admin\Setting\CommandController::class, 'index'])->name('command');

  //All the admin routes will be defined here...
  Route::get('/login',[AdminLoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login',[AdminLoginController::class, 'login'])->name('login.submit');
  Route::post('/logout',[AdminLoginController::class, 'logout'])->name('logout');

 	// Password reset routes
  Route::post('/password/email',[AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
  Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
  Route::get('/password/reset',[AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
  // Route::post('/password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.reset');

	 //Dashboard
  Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
  Route::get('/',[DashboardController::class, 'admin'])->name('admin');
  Route::get('/login_as_user/{user_id}', [DashboardController::class, 'login_as_user'])->name('login_as_user');

  //My Info
  Route::get('/my_info',[AdminController::class,'getMyInfo'])->name('get_my_info');
  Route::post('/my_info',[AdminController::class,'updateMyInfo'])->name('update_my_info');
  Route::get('/my_permission',[AdminController::class,'getMyPermission'])->name('get_my_permission');

  /*Appconfig-select category*/
  Route::get('app_configs/categories' ,[AppConfigController::class,'categories'])->name('app_configs.categories');
  Route::get('app_configs/categories/{category}' ,[AppConfigController::class,'index'])->name('app_configs');
  Route::post('app_config/processing', [AppConfigController::class,'processing'])->name('app_configs_processing');
  Route::post('app_config/{id}/update',[AppConfigController::class,'update'])->name('app_config_update');
  Route::get('app_config/{id}/category/{category}/edit', [AppConfigController::class,'edit'])->name('app_config_edit');

  /*Ajax routes*/
  Route::post('ajax/ajax_state_list', [AjaxController::class,'ajax_state_list'])->name('ajax_state_list');
  Route::post('ajax/ajax_city_list', [AjaxController::class,'ajax_city_list'])->name('ajax_city_list');
  Route::get('/ajax_marina',[AjaxController::class,'ajax_marina'])->name('ajax_marina');
  Route::get('ajax/state/{state_id}/cities',[AjaxController::class,'ajax_cities_of_state'])->name('ajax_cities_of_state');

  /*Marina*/
  Route::get('marina/{marina_id}/description',[MarinaDescriptionController::class,'marina_description'])->name('marina_description');
  Route::get('marina/{marina_id}/amenities',[MarinaAmenityController::class,'marina_amenities'])->name('marina_amenities_tab');
  Route::get('marina/{marina_id}/images',[MarinaImageController::class,'marina_image'])->name('marina_image');
  //Route::get('marina/{marina_id}/price',[MarinaPriceController::class,'marina_price'])->name('marina_price');
  Route::get('marina/{marina_id}/image_grid',[MarinaImageController::class,'marina_image_grid'])->name('marina_image_grid');

  Route::get('marina/{marina_id}/marina_owner',[MarinaOwnerController::class,'marina_owner'])->name('marina_owner');


  Route::post('marina/{marina_id}/description/store',[MarinaDescriptionController::class,'marina_description_store'])->name('marina_description_store');
  Route::post('marina/{marina_id}/amenities/store',[MarinaAmenityController::class,'marina_amenities_store'])->name('marina_amenities_store');
  Route::post('marina/{marina_id}/images/store',[MarinaImageController::class,'marina_image_store'])->name('marina_image_store');
  Route::post('marina/{marina_id}/marina_owner_store',[MarinaOwnerController::class,'marina_owner_store'])->name('marina_owner_store');


  //Route::post('marina/{marina_id}/price/store',[MarinaPriceController::class,'marina_price_store'])->name('marina_price_store');
  Route::post('marina/{marina_id}/image/{image_id}/delete',[MarinaImageController::class,'marina_image_delete'])->name('marina_image_delete');
  Route::post('marina/{marina_id}/image/{image_id}/status/store',[MarinaImageController::class,'marina_image_status_store'])->name('marina_image_status_store');

  Route::post('marina/{marina_id}/image/position/update',[MarinaImageController::class,'marina_image_position_update'])->name('marina_image_position_update');

  /*Boat Details*/
  Route::get('boat/{boat_id}/description',[BoatDescriptionController::class,'boat_description'])->name('boat_description');
  Route::get('boat/{boat_id}/images',[BoatImageController::class,'boat_image'])->name('boat_image');
  Route::get('boat/{boat_id}/price',[BoatPriceController::class,'boat_price'])->name('boat_price');
  Route::get('boat/{boat_id}/amenties',[BoatAmenityController::class,'boat_amenity'])->name('boat_amenity');
  Route::get('boat/{boat_id}/image_grid',[BoatImageController::class,'boat_image_grid'])->name('boat_image_grid');

  Route::post('boat/{boat_id}/description/store',[BoatDescriptionController::class,'boat_description_store'])->name('boat_description_store');

  Route::post('boat/{boat_id}/image/{image_id}/delete',[BoatImageController::class,'boat_image_delete'])->name('boat_image_delete');

  Route::post('boat/{boat_id}/images/store',[BoatImageController::class,'boat_image_store'])->name('boat_image_store');

  Route::post('boat/{boat_id}/price/store',[BoatPriceController::class,'boat_price_store'])->name('boat_price_store');
  Route::post('boat/{boat_id}/bulk/price/store',[BoatPriceController::class,'boat_bulk_price_store'])->name('boat_bulk_price_store');
  Route::post('boat/{boat_id}/amenties/store',[BoatAmenityController::class,'boat_amenity_store'])->name('boat_amenity_store');

  Route::post('boat/{boat_id}/image/{image_id}/status/store',[BoatImageController::class,'boat_image_status_store'])->name('boat_image_status_store');

  Route::post('boat/{boat_id}/image/position/update',[BoatImageController::class,'boat_image_position_update'])->name('boat_image_position_update');

  Route::get('boat/{boat_id}/change_log',[BoatChangeLogController::class,'index'])->name('boat.change_log');
  Route::post('boat/change_log/processing',[BoatChangeLogController::class,'processing'])->name('boat.change_log.processing');



  /*User Detail*/
  Route::get('user/{user_id}/detail',[UserDetailController::class,'user_detail'])->name('user_detail');
  Route::post('user/{user_id}/detail/store',[UserDetailController::class,'user_detail_store'])->name('user_detail_store');


  /*Cancellation Policy*/
  Route::get('setting/cancellation_policy',[SettingCancellationPolicy::class,'cancellation_policy'])->name('setting.cancellation_policy');
  Route::post('setting/cancellation_policy/store',[SettingCancellationPolicy::class,'cancellation_policy_store'])->name('setting.cancellation_policy_store');
  /*Weather Policy*/
  Route::get('setting/weather_policy',[SettingWeatherPolicy::class,'weather_policy'])->name('setting.weather_policy');
  Route::post('setting/weather_policy/store',[SettingWeatherPolicy::class,'weather_policy_store'])->name('setting.weather_policy_store');
  /*Fuel Policy*/
  Route::get('setting/fuel_policy',[SettingFuelPolicy::class,'fuel_policy'])->name('setting.fuel_policy');
  Route::post('setting/fuel_policy/store',[SettingFuelPolicy::class,'fuel_policy_store'])->name('setting.fuel_policy_store');


  /*Change Log*/
  Route::get('change_logs' ,[ChangeLogController::class,'index'])->name('change_logs');
  Route::post("change_logs/processing", [ChangeLogController::class,'processing'])->name('change_logs_processing');

  /*AppLanguage page*/
  Route::get('app_langs/pages' ,[AppLanguageController::class,'pages'])->name('app_langs.pages');
  Route::get('app_langs/pages/{page}' ,[AppLanguageController::class,'index'])->name('app_langs');
  Route::post('app_langs/processing', [AppLanguageController::class,'processing'])->name('app_langs_processing');
  Route::post('app_lang/{id}/update',[AppLanguageController::class,'update'])->name('app_lang_update');
  Route::get('app_lang/{id}/page/{page}/edit', [AppLanguageController::class,'edit'])->name('app_lang_edit');

  /********BoatType Postion******/
  Route::get('boat_type/position',[BoatTypeController::class,'position'])->name('boat_type.position');
    Route::post('boat_type/position/update',[BoatTypeController::class,'positionUpdate'])->name('boat_type.position.update');

 /*****Company*************/
  Route::get('company/{company_id}/change_log',[CompanyChangeLogController::class,'index'])->name('company.change_log');
  Route::post('company/change_log/processing',[CompanyChangeLogController::class,'processing'])->name('company.change_log.processing');



  $route = array();

  /*Country*/
  $route[] = array(
    'controller' => CountryController::class,
    'singular'    => "country",
    'plural' => "countries",
    'server_porcessing' => 1
  );

  /*State*/
  $route[] = array(
    'controller' => StateController::class,
    'singular'    => "state",
    'plural' => "states",
    'server_porcessing' => 1
  );

  /*City*/
  $route[] = array(
    'controller' => CityController::class,
    'singular'    => "city",
    'plural' => "cities",
    'server_porcessing' => 1
  );


  /*Boat Type*/
  $route[] = array(
    'controller' => BoatTypeController::class,
    'singular'    => "boat_type",
    'plural' => "boat_types",
    'server_porcessing' => 1
  );

  /*Boat Manufacturer*/
  $route[] = array(
    'controller' => BoatManufacturerController::class,
    'singular'    => "boat_manufacturer",
    'plural' => "boat_manufacturers",
    'server_porcessing' => 1
  );
  /*Boat Amenity*/
  $route[] = array(
    'controller' => BoatAmenityController::class,
    'singular'    => "boat_amenity",
    'plural' => "boat_amenities",
    'server_porcessing' => 1
  );
  /*Body Of Water*/
  $route[] = array(
    'controller' => BodyOfWaterController::class,
    'singular'    => "body_of_water",
    'plural' => "body_of_waters",
    'server_porcessing' => 1
  );
  /*Marina Amenity*/
  $route[] = array(
    'controller' => MarinaAmenityController::class,
    'singular'    => "marina_amenity",
    'plural' => "marina_amenities",
    'server_porcessing' => 1
  );
  /*Users*/
  $route[] = array(
    'controller' => UserController::class,
    'singular'    => "user",
    'plural' => "users",
    'server_porcessing' => 1
  );
  /*Admins*/
  $route[] = array(
    'controller' => AdminController::class,
    'singular'    => "admin",
    'plural' => "admins",
    'server_porcessing' => 1,
    'extra' =>  array( 
        array('get'=> 'permissions'),
     ),
  );
  /*Admins Roles*/
  $route[] = array(
        'controller' => AdminRoleController::class,
        'singular'    => "admin_role",
        'plural' => "admin_roles",
        'server_porcessing' => 1
  );


  /*Marina*/
  $route[] = array(
    'controller' => MarinaController::class,
    'singular'    => "marina",
    'plural' => "marinas",
    'server_porcessing' => 1
  );
  /*Boat*/
  $route[] = array(
    'controller' => BoatController::class,
    'singular'    => "boat",
    'plural' => "boats",
    'server_porcessing' => 1
  );

  /*FAQ Category*/
  $route[] = array(
    'controller' => FaqCategoryController::class,
    'singular'    => "faq_category",
    'plural' => "faq_categories",
    'server_porcessing' => 1
  );

  /*FAQ Detail*/
  $route[] = array(
    'controller' => FaqDetailController::class,
    'singular'    => "faq_detail",
    'plural' => "faq_details",
    'server_porcessing' => 1
  );

  /*Blog Category*/
  $route[] = array(
    'controller' => BlogCategoryController::class,
    'singular'    => "blog_category",
    'plural' => "blog_categories",
    'server_porcessing' => 1
  );

  /*Blog Category*/
  $route[] = array(
    'controller' => BlogDetailController::class,
    'singular'    => "blog_detail",
    'plural' => "blog_details",
    'server_porcessing' => 1
  );

  /*Government Document*/
  $route[] = array(
    'controller' => GovernmentDocumentController::class,
    'singular'    => "government_document",
    'plural' => "government_documents",
    'server_porcessing' => 1
  );

  /*Deposite Reason*/
  $route[] = array(
    'controller' => DepositeReasonController::class,
    'singular'    => "deposite_reason",
    'plural' => "deposite_reasons",
    'server_porcessing' => 1
  );

  /**** OperatorInquiryController */
  $route[] = array(
    'controller' => OperatorInquiryController::class,
    'singular'    => "rental_operator_inquiry",
    'plural' => "rental_operator_inquiries",
    'server_porcessing' => 1,
    'extra' =>  array( 
        array('get'=> 'action'),
        array('post'=> 'saveAction'),
     ),
  );

   $route[] = array(
    'controller' => CompanyController::class,
    'singular'    => "company",
    'plural' => "companies",
    'server_porcessing' => 1,
    'extra' =>  array( 
        array('get'=> 'users'),
     ),
  );

  

  /******* HomeDestinationController  */
  $route[] = array(
    'controller' => App\Http\Controllers\Admin\HomePage\HomeDestinationController::class,
    'singular'    => "home_destination",
    'plural' => "home_destinations",
    'server_porcessing' => 1
  );
  /******* HomeTestimonialController  */
  $route[] = array(
    'controller' => App\Http\Controllers\Admin\HomePage\HomeTestimonialController::class,
    'singular'    => "home_testimonial",
    'plural' => "home_testimonials",
    'server_porcessing' => 1
  );

  foreach ($route as $r){

    $plural = $r['plural'];
    $singular = $r['singular'];
    $controller = $r['controller'];

    Route::get($plural ,[$controller,'index'])->name($plural);
    Route::get("{$singular}/{id}/edit", [$controller,'edit'])->name($singular."_edit");
    Route::get("{$singular}/create",[$controller,'create'])->name($singular."_create");
    Route::post("{$singular}/{id}/update", [$controller,'update'])->name($singular."_update");
    Route::post("{$singular}/{id}/delete", [$controller,'delete'])->name($singular."_delete");

    if(isset($r['server_porcessing'])){
      Route::post("{$singular}/processing", [$controller,'processing'])->name($plural.'_processing');

    }
    if(isset($r['extra'])){
      foreach($r['extra'] as $_k => $extra_arr){

        $metod = array_key_first($extra_arr);
        $fun = $extra_arr[$metod];
        $_fun = str_replace("/{type_id}","",$fun);

        if($metod == 'get'){
          Route::get("{$singular}/{id}/".$fun, [$controller,$_fun])->name($singular."_".$_fun);
        }
        if($metod == 'post'){
          Route::post("{$singular}/{id}/".$fun, [$controller,$_fun])->name($singular."_".$_fun);
        }
      }
    }

    if(isset($r['dependencies']) and is_array($r['dependencies'])){
      $dependency = $r['dependencies'];
      $dep_plural = $dependency['plural'];
      $dep_singular = $dependency['singular'];
      $dep_controller = $dependency['controller'];
      $processing =  (isset($dependency['server_porcessing']) and $dependency['server_porcessing'])?1:0;

      Route::get("{$singular}/{{$singular}_id}/{$dep_plural}" ,[$dep_controller,'index'])->name("{$singular}_{$dep_plural}");
      Route::get("{$singular}/{{$singular}_id}/{$dep_singular}/{id}/edit", [$dep_controller,'edit'])->name("{$singular}_{$dep_singular}_edit");
      Route::get("{$singular}/{{$singular}_id}/{$dep_singular}/create", [$dep_controller,'create'])->name("{$singular}_{$dep_singular}_create");
      Route::post("{$singular}/{{$singular}_id}/{$dep_singular}/{id}/update", [$dep_controller,'update'])->name("{$singular}_{$dep_singular}_update");
      Route::post("{$singular}/{{$singular}_id}/{$dep_singular}/{id}/delete", [$dep_controller,'delete'])->name("{$singular}_{$dep_singular}_delete");

      if($processing){
        Route::post("{$singular}/{{$singular}_id}/{$dep_plural}/processing", [$dep_controller,'processing'])->name($singular."_". $dep_plural.'_processing');

      }
    }


  }



});
