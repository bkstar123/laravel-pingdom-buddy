<?php
/**
 * PingdomTest
 *
 * @author: tuanha
 * @date: 23-Apr-2024
 */
namespace Bkstar123\PingdomBuddy\Services;

use Exception;
use Bkstar123\PingdomBuddy\Services\PingdomBase;

class PingdomTest extends PingdomBase
{
    /**
     * Perform availability test
     *
     * @param integer $offset
     * @param integer $limit
     *
     * @return false||array
     */
    public function testAvailability($hostname = "", $shouldcontain = "", $shouldnotcontain = "", $sslPriorExpiration = 1, $targetPath = "/", $testFrom = "")
    {
        $path = "single?host=$hostname&type=http";
        if (!empty($sslPriorExpiration)) {
            $path .= "&ssl_down_days_before=$sslPriorExpiration";
        }
        if (!empty($shouldcontain)) {
            $path .= "&shouldcontain=$shouldcontain";
        }
        if (!empty($shouldnotcontain)) {
            $path .= "&shouldnotcontain=$shouldnotcontain";
        }
        if (!empty($targetPath)) {
            $path .= "&url=$targetPath";
        }
        if (!empty($testFrom)) {
            $path .= "&probe_filters=region:$testFrom";
        }
        try {
            $res = $this->client->request('GET', $path);
            $data = json_decode($res->getBody()->getContents(), true);
            return $data['result'] ?? false;
        } catch (Exception $e) {
            return false;
        }
    }
}