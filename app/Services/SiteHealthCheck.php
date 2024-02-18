<?php


namespace App\Services;

use App\Models\Site;
use Illuminate\Support\Facades\Http;
use App\Models\SiteDownLog;

class SiteHealthCheck
{
    public function checkSiteHealth()
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            $url = $site->url;

            $response = Http::get($url);

            $collections = [
                'url' => $url,
                'status' => $response->status(),
            ];

            //print status in console
            echo $collections['status'] .  $collections['url'] . "\n";

            // if the site response other than 200, log the status using SiteDownLog


            if ($collections['status'] != 500) {

                //deactivate the site when the site is down
                $site = Site::where('url', $collections['url'])->first();
                $site->is_active = 0;

                $siteDownLog = new SiteDownLog();
                $siteDownLog->url = $collections['url'];
                $siteDownLog->status = $collections['status'];
                $siteDownLog->save();
            }
        }
    }
}



?>
