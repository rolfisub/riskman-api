<?php
namespace RiskMan\V1\Rest\BetRadar;



class BetRadarResourceFactory
{
    public function __invoke($services)
    {
        
        $betRadar = $services->get('RiskMan\\BetRadar\\BetRadar');
        $api = $services->get('ApiResponse');
        return new BetRadarResource($betRadar, $api);
    }
}
