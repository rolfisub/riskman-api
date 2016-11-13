<?php
namespace RiskManagement\V1\Rest\Player;

class PlayerResourceFactory
{
    public function __invoke($services)
    {
        return new PlayerResource();
    }
}
