<?php
/**
 * Base for other Pingdom services
 *
 * @author: tuanha
 * @date: 23-Oct-2021
 */
namespace Bkstar123\PingdomBuddy\Services;

class PingdomBase
{
    /**
     * @var $httpCLient resorce
     */
    protected $httpCLient;

    /**
     * @var $baseUrl string
     */
    protected $baseUrl;

    /**
     * Initialize new instance
     */
    public function __construct()
    {
        $this->baseUrl = config('bkstar123_laravel_pingdombuddy.pingdom.base_url');

        $this->httpCLient = curl_init();
        curl_setopt_array($this->httpCLient, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer " . config('bkstar123_laravel_pingdombuddy.pingdom.api_token'),
                "cache-control: no-cache",
            ]
        ]);
    }

    /**
     * Execute request to Pingdom Endpoint
     * @return array
     */
    protected function execute()
    {
        $result = curl_exec($this->httpCLient);
        $executionError = curl_error($this->httpCLient);
        if ($executionError) {
            return [
                'executionStatus' => false,
                'data' => $executionError
            ];
        } else {
            return [
                'executionStatus' => true,
                'data' => $result
            ];
        }
    }

    public function __destruct()
    {
        curl_close($this->httpCLient);
    }
}
