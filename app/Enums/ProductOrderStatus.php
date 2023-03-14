<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductOrderStatus extends Enum
{
    const MENUNGGU_DIBAYAR = "0";
    const MENUNGGU_RESI = "1";
    const SEDANG_DIKIRIM = "2";
    const ORDER_SELESAI = "3";
    const DIBATALKAN = "4";
}
