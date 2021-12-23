<?php

namespace Database\Seeders;

use App\Models\User\Admin;
use App\Models\User\AdminRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\System\AppLanguage;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $langArray = array();
        /*** footer */
        $langArray['footer_copyright'] = array("lang_name" => "Footer Copyright","page"=>"footer","data_value" => "- NEWWAVEHARBOR - All Rights Reserved");

        /*** homepage */
        $langArray['home_banner_title'] = array("lang_name" => "Home Banner Title","page"=>"homepage","data_value" => "A New Wave in Boat Rental Industry");
        
        foreach($langArray as $lang_key => $lang){
            $appLang = AppLanguage::where("lang_key",$lang_key)->first();
            if(!$appLang){
                $appLang  = new AppLanguage();
                $appLang->lang_key = $lang_key;
                $appLang->lang_name = $lang['lang_name'];
                $appLang->data_type = isset($lang['data_type'])?$lang['data_type']:"string";
                $appLang->page = $lang['page'];
                $appLang->data_value = isset($lang['data_value'])?$lang['data_value']:$lang['lang_name'];
                $appLang->save();
            }
        }

         

    }
}
