<?php
/**
 * PingdomCheck
 *
 * @author: tuanha
 * @date: 23-Oct-2021
 */
namespace Bkstar123\PingdomBuddy\Services;

use Bkstar123\PingdomBuddy\Services\PingdomBase;

class PingdomCheck extends PingdomBase
{
    /**
     * Get overview of all Pingdom checks
     *
     * @param integer $offset
     * @param integer $limit
     *
     * @return false||array
     */
    public function getChecks($offset = 0, $limit = 25000)
    {
        $path = "checks?include_tags=true&offset=$offset&limit=$limit";
        try {
            $res = $this->client->request('GET', $path);
            $data = json_decode($res->getBody()->getContents(), true);
            return $data['checks'];
        } catch (Exception $e) {
            return false;
        }
    }
}