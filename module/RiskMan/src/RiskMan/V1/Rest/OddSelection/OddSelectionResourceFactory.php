<?php
namespace RiskMan\V1\Rest\OddSelection;

class OddSelectionResourceFactory
{
    public function __invoke($services)
    {
        $dos = $services->get('RiskMan\\Domain\\Feed\\OddSelection');
        $api = $services->get('ApiResponse');
        return new OddSelectionResource($dos, $api);
    }
}
