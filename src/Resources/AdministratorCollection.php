<?php

namespace Koraycicekciogullari\HydroAdministrator\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdministratorCollection extends ResourceCollection
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        return AdministratorResource::collection($this->collection);
    }
}
