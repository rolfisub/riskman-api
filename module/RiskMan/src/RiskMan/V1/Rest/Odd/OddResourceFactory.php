<?php
namespace RiskMan\V1\Rest\Odd;

class OddResourceFactory
{
    public function __invoke($services)
    {
        return new OddResource();
    }
}