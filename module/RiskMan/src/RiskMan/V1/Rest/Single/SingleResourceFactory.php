<?php
namespace RiskMan\V1\Rest\Single;

class SingleResourceFactory
{
    public function __invoke($services)
    {
        $ds = $services->get('RiskMan\\Domain\\Bet\\Single');
        $api = $services->get('ApiResponse');
        return new SingleResource($ds, $api);
    }
}
