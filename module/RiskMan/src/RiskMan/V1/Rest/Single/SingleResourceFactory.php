<?php
namespace RiskMan\V1\Rest\Single;

class SingleResourceFactory
{
    public function __invoke($services)
    {
        return new SingleResource($services);
    }
}
