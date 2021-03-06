<?php
namespace RiskMan\V1\Rest\Odd;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

use RiskMan\Domain\Feed\Odd;
use ApiResponse\ApiResponse;

class OddResource extends AbstractResourceListener
{
    protected $do;
    protected $api;
    
    public function __construct(Odd $do, ApiResponse $api) { 
        
        if (null === $this->do) {
            $this->do = $do;
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
        $this->do->setBookId($this->getIdentity()->getRoleId());
        //manual filter, it should be valid already (workaround)
        if(isset($data->datetime)){
           $data->datetime =  date("Y-m-d g:i:s", strtotime($data->datetime));
        }
        
        $response = $this->do->create($data);
        //return response
        return $this->api->sendResponse(
            $response->code,
            $response->details,
            $response->type,
            $response->title,
            ['data' => $response->data]
        );
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
