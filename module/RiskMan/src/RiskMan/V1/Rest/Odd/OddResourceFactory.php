<?php
namespace RiskMan\V1\Rest\Odd;

class OddResourceFactory
{
    public function __invoke($services)
    {
        $do = $services->get('RiskMan\\Domain\\Feed\\Odd');
        $api = $services->get('ApiResponse');
        return new OddResource($do, $api);
    }
}
