<?php
namespace RiskMan\V1\Rest\Sport;

class SportResourceFactory
{
    public function __invoke($services)
    {
        return new SportResource();
    }
}
