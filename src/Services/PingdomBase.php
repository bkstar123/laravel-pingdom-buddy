<?php
/**
 * Base for other Pingdom services
 *
 * @author: tuanha
 * @date: 23-Oct-2021
 */
namespace Bkstar123\PingdomBuddy\Services;

use GuzzleHttp\Client;

class PingdomBase
{
    /**
     * @var $client resource
     */
    protected $client;

    /**
     * Initialize new instance
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('bkstar123_laravel_pingdombuddy.pingdom.base_url'),
            'headers'  => [
                "Authorization"   => "Bearer " . config('bkstar123_laravel_pingdombuddy.pingdom.api_token'),
                "Cache-Control"   => "no-cache",
                "Accept-Encoding" => "gzip"
            ]
        ]);
    }
}
