<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ServiceOrderStatus extends Enum
{
    const MENCARI_TEKNISI = "0";
    const DALAM_SERVIS = "1";
    const SERVIS_SELESAI = "2";
    const DIBATALKAN = "3";
}
