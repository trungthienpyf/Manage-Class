<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ShiftClassEnum extends Enum
{
    const ShiftOne =   1;
    const ShiftTwo =   2;
    const ShiftThree = 3;
    public static function getShift($value)
    {
        switch ($value) {
            case 1:
                return 'Shift One';
                break;
            case 2:
                return 'Shift Two';
                break;
            case 3:
                return 'Shift Three';
                break;
        }
    }
}
