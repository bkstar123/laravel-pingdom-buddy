<?php
/**
 * PingdomCheck
 *
 * @author: tuanha
 * @date: 23-Oct-2021
 */
namespace Bkstar123\PingdomBuddy\Services;

use Exception;
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
    public function getChecks($offset = 0, $limit = 25000, $tags = "")
    {
        $tagList = !empty($tags) ? "&tags=$tags" : "";
        $path = "checks?include_tags=true&offset=$offset&limit=$limit" . $tagList;
        try {
            $res = $this->client->request('GET', $path);
            $data = json_decode($res->getBody()->getContents(), true);
            return $data['checks'];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get details about a check
     *
     * @param string $checkID
     *
     * @return false | array
     */
    public function getCheck($checkID)
    {
        $path = "checks/$checkID";
        try {
            $res = $this->client->request('GET', $path);
            $data = json_decode($res->getBody()->getContents(), true);
            return $data['check'];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the average time / uptime value for a specified check and time period
     *
     * @param string $checkID
     * @param string $from
     * @param string $to
     *
     * @return false | array
     */
    public function getCheckSummaryAverage($checkID, $from, $to)
    {
        $path = "summary.average/$checkID?includeuptime=true&from=$from&to=$to";
        try {
            $res = $this->client->request('GET', $path);
            $data = json_decode($res->getBody()->getContents(), true);
            return $data['summary'];
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get a list of status changes for a specified check
     *
     * @param string $checkID
     * @param string $from
     * @param string $to
     *
     * @return false | array
     */
    public function getCheckSummaryOutage($checkID, $from, $to)
    {
        $path = "summary.outage/$checkID?from=$from&to=$to";
        try {
            $res = $this->client->request('GET', $path);
            $data = json_decode($res->getBody()->getContents(), true);
            return $data['summary']['states'];
        } catch (Exception $e) {
            return false;
        }
    }
}