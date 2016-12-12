<?php
/**
 * ApiLog
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace ApiResponse\ApiLog;
use ApiResponse\ApiLog\ApiLogModel;
use Zend\Http\PhpEnvironment\Request;

class ApiLog
{
    
    protected $Model;
    public function __construct(ApiLogModel $model) 
    {
        if ($this->Model === null) {
            $this->Model = $model;
        }
    }
    
    public function Log ($status, $detail, $type = null, $title = null, array $additional = array(), $user_id = -1)
    {
        $response = new Request();
        $received = $response->getContent();
        $uri = $response->getUri();
        $rec_decoded = json_decode($received);
        if ($rec_decoded !== NULL) {
            $received = json_encode($rec_decoded);
        }
        $arr = explode('/', $response->getUri());
        $service_name = $response->getUri();
        if (isset($arr[sizeof($arr)-1])) {
            $service_name = $arr[sizeof($arr)-1];
        }
        $this->Model->save_log(
            array(
                'ip_address' => ($response->getServer('REMOTE_ADDR')== null ? 0 :$response->getServer('REMOTE_ADDR')),
                'user_id' => $user_id,
                'service_name' => $service_name,
                'url' => $response->getServer('HTTP_HOST') . $response->getUri(),
                'http_method' => $response->getMethod(),
                'http_code' => $status,
                'http_message' => $title . ' ' . $detail,
                'http_header' => $response->getHeaders()->toString(),
                'received_data' => $received,
                'sent_data' => json_encode($additional),
            )
        );
    }
}
