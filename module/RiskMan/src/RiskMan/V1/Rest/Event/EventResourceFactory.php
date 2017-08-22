<?php
namespace RiskMan\V1\Rest\Event;

class EventResourceFactory
{
    public function __invoke($services)
    {
        $de = $services->get('RiskMan\Domain\Feed\Event');
        $api = $services->get('ApiResponse');
        return new EventResource($de, $api);
    }
}
