<?php
namespace RiskMan\V1\Rest\BetRadar;

class BetRadarResourceFactory
{
    public function __invoke($services)
    {
        return new BetRadarResource();
    }
}
