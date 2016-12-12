<?php
/**
 * ApiLogModel
 *
 * @package   WebServices 
 * @author    Rolf
 * @copyright Copyright 2016 Trxadegroup, Inc.
 */

namespace ApiResponse\ApiLog;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class ApiLogModel 
{
    
    protected $adapter;
    public function __construct (Adapter $adapter) 
    {
        if ($this->adapter === null) {
            $this->adapter = $adapter;
        }
    }
    
    public function save_log (array $data = array()) 
    {
        $sql = new Sql($this->adapter);
        $insert = $sql->insert("apilog");
        $insert->columns(array(
            'ip_address',
            'user_id',
            'service_name',
            'url',
            'http_method',
            'http_code',
            'http_message',
            'received_data',
            'sent_data'
        ));
        $insert->values($data);
        $stmt = $sql->prepareStatementForSqlObject($insert);
        $stmt->execute();
    }
}
