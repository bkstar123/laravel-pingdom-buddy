<?php
/**
 * PingdomCheck
 *
 * @author: tuanha
 */
namespace Bkstar123\PingdomBuddy\Services;

use Bkstar123\PingdomBuddy\Services\PingdomBase;

class PingdomCheck extends PingdomBase
{
    /**
     * Get overview of all Pingdom checks
     *
     * @return false||array
     */
    public function getChecks()
    {
        $path = '/checks?include_tags=true';
        curl_setopt($this->httpCLient, CURLOPT_URL, $this->baseUrl . $path);
        curl_setopt($this->httpCLient, CURLOPT_CUSTOMREQUEST, 'GET');
        $result = $this->execute();
        if ($result['executionStatus']) {
            if (property_exists(json_decode($result['data']), 'error')) {
                return false;
            } else {
                return json_decode($result['data'])->checks;
            }
        } else {
            return false;
        }
    }
}
