<?php

namespace Database\Seeders;

use App\Models\Setting;
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

        DB::table('settings')->insert([
            [ 'key' => 'site_name', 'value' => env('APP_NAME', 'IRAYOL'),],
            [ 'key' => 'theme_active', 'value' => env('APP_THEME', 'default'),],
            [ 'key' => 'site_logo', 'value' => null, ],
            [ 'key' => 'site_url', 'value' => '/', ],
            [ 'key' => 'email_address', 'value' => '', ],
            [ 'key' => 'keyword_seo', 'value' => '', ],
            [ 'key' => 'desc_seo', 'value' => '', ],
            [ 'key' => 'favicon', 'value' => '', ],
            [ 'key' => 'googleanalytic_key', 'value' => '', ],
            [ 'key' => 'revistafter', 'value' => '', ],
            [ 'key' => 'robots', 'value' => '', ],
            [ 'key' => 'main_page', 'value' => '', ],
            [ 'key' => 'main_menu', 'value' => '', ],
            [ 'key' => 'app_lang', 'value' => env('APP_LANG', 'es'), ],
            [ 'key' => 'currency_code', 'value' => 'USD', ],
        ]);
    }
}
