<?php
namespace RiskManagement\V1\Rest\MultipleSelection;

class MultipleSelectionResourceFactory
{
    public function __invoke($services)
    {
        return new MultipleSelectionResource();
    }
}
