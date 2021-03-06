<?php
namespace RiskMan\V1\Rest\Event;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use RiskMan\Domain\Feed\Event;
use ApiResponse\ApiResponse;

class EventResource extends AbstractResourceListener
{
    /*
     * @var RiskMan\Domain\Event
     */
    protected $de;
    
    /*
     * @var ApiResponse\ApiResponse
     */
    protected $api;
    
   
    
    public function __construct(Event $de, ApiResponse $api) 
    {   
        if (null === $this->de) {
            $this->de = $de;
        }
        if (null === $this->api) {
            $this->api = $api;
        }
    }
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $this->de->setBookId($this->getIdentity()->getRoleId());
        //manual filter, it should be valid already (workaround)
        if(isset($data->datetime)){
           $data->datetime =  date("Y-m-d g:i:s", strtotime($data->datetime));
        }
        $response = $this->de->create($data);
        return $this->api->sendResponse(
            $response->code,
            $response->details,
            $response->type,
            $response->title,
            ['data' => $response->data]
        );
        //return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        //echo "test\n";
        /*$id = $this->de->getEventId($id, 2);
        $event = $this->de->getEvent($id);
        $json = $event->exportTo('json');
        echo $json;
        die();*/
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
