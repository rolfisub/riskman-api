<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Admin\Controller;

use Admin\Controller\ProtectedRestfulController;
use Zend\View\Model\JsonModel;

use Admin\Model\Stats;

class StatsRestController extends ProtectedRestfulController
{
    protected $stats;
    public function __construct($cn, Stats $stats) 
    {
       $this->stats = $stats;
       parent::__construct($cn);
    }
    
    public function getList() 
    {
       return new JsonModel($this->stats->getAllStats());
    }
}
