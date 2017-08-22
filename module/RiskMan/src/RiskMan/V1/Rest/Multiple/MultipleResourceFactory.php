<?php
namespace RiskMan\V1\Rest\Multiple;



class MultipleResourceFactory
{
    public function __invoke($services)
    {
        $dm = $services->get('RiskMan\\Domain\\Bet\\Multiple');
        $api = $services->get('ApiResponse');
        return new MultipleResource($dm, $api);
    }
}
