<?php
/**
 * ApiResponse
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace ApiResponse;
use ApiResponse\ApiLog\ApiLog;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Mvc\ResponseSender\SendResponseEvent;
use Zend\Http\PhpEnvironment\Request;

class ApiResponse 
{
    
    protected $Log;
    protected $oauthServer;
    protected $auth;
    protected static $user_id;
    
    public function __construct (ApiLog $Log, $oauthServer = null) 
    {
        if ($this->Log === null) {
            $this->Log = $Log;
        }
        if ($oauthServer !== null) {
            $this->oauthServer = $oauthServer;
        }
    }
     
    public function sendResponse ($status, $detail, $type = null, $title = null, array $additional = array())
    {
        return new ApiProblem($status, $detail, $type, $title, $additional);
    }
    
    public function catchEvent (SendResponseEvent $e = null)
    {
        $user_id = 1;
        if($this->oauthServer){
            $token = $this->oauthServer->getAccessTokenData(\OAuth2\Request::createFromGlobals());
            $user_id = null;
            if (isset($token['client_id'])) {
                $user_id = $token['client_id'];
            }
        }
        if ($user_id !== null) {
            $response = $e->getResponse();
            $request = new Request();
            if ($response instanceof ApiProblemResponse) {
                $apiprob = $response->getApiProblem();
                $apiarr = $apiprob->toArray();
                $this->Log->Log($apiarr['status'], $apiarr['detail'], $request->getMethod(),$apiarr['title'],$apiarr,$user_id);
            }
            else {
                $status = $response->getStatusCode();
                $detail = $response->getReasonPhrase();
                $title = '';
                $additional = array();
                $this->Log->Log($status, $detail,$request->getMethod(),$title,$additional,$user_id);
            }
            return true;
        }
        return false;
    }
}
