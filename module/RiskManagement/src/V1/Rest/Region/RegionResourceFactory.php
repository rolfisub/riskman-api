<?php
namespace RiskManagement\V1\Rest\Region;

class RegionResourceFactory
{
    public function __invoke($services)
    {
        return new RegionResource();
    }
}
