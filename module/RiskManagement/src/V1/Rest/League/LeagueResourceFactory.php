<?php
namespace RiskManagement\V1\Rest\League;

class LeagueResourceFactory
{
    public function __invoke($services)
    {
        return new LeagueResource();
    }
}
