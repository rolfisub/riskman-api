<?php
namespace RiskMan\V1\Rest\Event;

class EventResourceFactory
{
    public function __invoke($services)
    {
        return new EventResource();
    }
}
