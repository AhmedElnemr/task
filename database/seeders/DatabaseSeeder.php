<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin::create([
            'email' => "admin@admin.com",
            'phone' => "01025130204",
            'password' => bcrypt(123456),
        ]);


        $settings = array(
            array('id' => '1','terms_condition_link' => 'terms_condition_link','about_us_link' => 'terms_condition_link','privacy_policy_link' => 'terms_condition_link','header_logo' => 'terms_condition_link','footer_logo' => 'terms_condition_link','login_banner' => 'terms_condition_link','image_slider' => 'terms_condition_link','ar_title' => 'terms_condition_link','en_title' => 'terms_condition_link','ar_desc' => 'terms_condition_link','en_desc' => 'terms_condition_link','ar_footer_desc' => 'terms_condition_link','en_footer_desc' => 'terms_condition_link','company_profile_pdf' => 'terms_condition_link','address1' => 'terms_condition_link','address2' => 'terms_condition_link','latitude' => '0','longitude' => '0','phone1' => 'terms_condition_link','phone2' => 'terms_condition_link','fax' => 'terms_condition_link','android_app' => 'terms_condition_link','ios_app' => 'terms_condition_link','email1' => 'terms_condition_link','email2' => 'terms_condition_link','link' => 'terms_condition_link','sms_user_name' => 'terms_condition_link','sms_user_pass' => 'terms_condition_link','sms_sender' => 'terms_condition_link','publisher' => 'terms_condition_link','default_language' => 'ar','default_theme' => 'terms_condition_link','offer_muted' => 'terms_condition_link','offer_notification' => '1','facebook' => 'terms_condition_link','twitter' => 'terms_condition_link','instagram' => 'terms_condition_link','linkedin' => 'terms_condition_link','telegram' => 'terms_condition_link','youtube' => 'terms_condition_link','google_plus' => 'terms_condition_link','snapchat_ghost' => 'terms_condition_link','whatsapp' => 'terms_condition_link','ar_about_app' => 'terms_condition_link','en_about_app' => 'terms_condition_link','ar_terms_condition' => 'terms_condition_link','en_terms_condition' => 'terms_condition_link','ar_privacy_policy' => 'terms_condition_link','en_privacy_policy' => 'terms_condition_link','site_commission' => '1','debt_limit' => '1','created_at' => '2022-06-02 15:55:27','updated_at' => '2022-06-02 15:55:27')
        );
        \App\Models\Setting::insert($settings);




    }//end public
}
