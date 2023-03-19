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
    const MENUNGGU_KONFIRMASI_TEKNISI = "1";
    const DALAM_SERVIS = "2";
    const SERVIS_SELESAI = "3";
    const DIBATALKAN = "4";
}
