<?php

namespace Koraycicekciogullari\HydroAdministrator\Helpers;

use Illuminate\Support\Facades\Hash;

/**
 * Class AdminPanelHelpers
 */
class AdminPanelHelpers
{

    /**
     * @param $value
     * @return string
     */
    public function makePassword($value): string
    {
        return Hash::make($value);
    }

}
