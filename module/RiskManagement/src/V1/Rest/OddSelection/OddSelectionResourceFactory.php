<?php
namespace RiskManagement\V1\Rest\OddSelection;

class OddSelectionResourceFactory
{
    public function __invoke($services)
    {
        return new OddSelectionResource();
    }
}
