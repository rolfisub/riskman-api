<?php
namespace RiskMan\V1\Rest\Event;

class EventResourceFactory
{
    public function __invoke($services)
    {
        $de = $services->get('RiskMan\Domain\DEvent');
        return new EventResource($de);
    }
}
