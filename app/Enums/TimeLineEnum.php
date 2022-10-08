<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TimeLineEnum extends Enum
{
    const TwoWeek =   1;
    const FiveWeek =   2;
    const SevenWeek = 3;
    public static function getViewArray(){
        return [
            '2 Tuần' => self::TwoWeek,
            '5 Tuần' => self::FiveWeek,
            '7 Tuần' => self::SevenWeek,
        ];
    }
}
