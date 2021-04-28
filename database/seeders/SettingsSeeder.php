<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        Setting::insert([
            [ 'key' => 'site_name', 'value' => env('APP_NAME', 'IRAYOL'), 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'theme_active', 'value' => env('APP_THEME', 'default'),'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'site_logo', 'value' => null, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'site_url', 'value' => '/', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'email_address', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'keyword_seo', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'desc_seo', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'favicon', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'googleanalytic_key', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'revistafter', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'robots', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'main_page', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'main_menu', 'value' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'app_lang', 'value' => env('APP_LANG', 'es'), 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            [ 'key' => 'currency_code', 'value' => 'USD', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
