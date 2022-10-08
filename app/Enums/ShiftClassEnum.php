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
    public  static function  getViewArray(){
        return[
            'Sáng'=>self::ShiftOne,
            'Chiều'=>self::ShiftTwo,
            'Tối'=>self::ShiftThree,
        ];
    }
    public static function getShift($value)
    {
        switch ($value) {
            case 1:
                return 'Sáng';
                break;
            case 2:
                return 'Chiều';
                break;
            case 3:
                return 'Tối';
                break;
        }
    }

    public function getTimeOfShift($value)
    {
        switch ($value) {
            case 1:
                return ['07:30:00','11:30:00'];
                break;
            case 2:
                return ['12:30:00','14:30:00'];
                break;
            case 3:
                return ['18:00:00','20:30:00'];
                break;
        }
    }
}
