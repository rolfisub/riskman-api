<?php
namespace RiskManagement\V1\Rest\Multiple;

class MultipleResourceFactory
{
    public function __invoke($services)
    {
        return new MultipleResource();
    }
}
