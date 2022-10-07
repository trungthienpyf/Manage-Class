<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class WeekdaysClassEnum extends Enum
{
    const T2T5 =   1;
    const T2T6 =   2;
    const T4T7 = 3;
    const T3T5 = 4;
    const T3T6 = 5;
    const T5T7 = 6;
    const T2T4T6 = 7;
    const T3T5T7 = 8;
    public function getViewArray(){
        return [
            "Thứ 2-5"=>self::T2T5,
            "Thứ 2-6"=>self::T2T6,
            "Thứ 4-7"=>self::T4T7,
            "Thứ 3-5"=>self::T3T5,
            "Thứ 3-6"=>self::T3T6,
            "Thứ 5-7"=>self::T5T7,
            "Thứ 2-4-6"=>self::T2T4T6,
            "Thứ 3-5-7"=>self::T3T5T7,
        ];
    }
    public static function  getNameEnum($value)
    {
        switch ($value) {
            case 1:
                return 'T2-T5';
                break;
            case 2:
                return 'T2-T6';
                break;
            case 3:
                return 'T4-T7';
                break;
            case 4:
                return 'T3-T5';
                break;
            case 5:
                return 'T3-T6';
                break;
            case 6:
                return 'T5-T7';
                break;
            case 7:
                return 'T2-T4-T6';
                break;
            case 8:
                return 'T3-T5-T7';
                break;
        }
    }

    public static function  getWeekdays($value)
    {
        switch ($value) {
            case 1:
                return [2, 5];
            case 2:
                return [2, 6];
            case 3:
                return [4, 7];
            case 4:
                return [3, 5];
            case 5:
                return [3, 6];
            case 6:
                return [5, 7];
            case 7:
                return [2, 4, 6];
            case 8:
                return [3, 5, 7];
        }
    }
}
