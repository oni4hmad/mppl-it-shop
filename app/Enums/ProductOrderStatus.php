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
    const MENUNGGU_PEMBAYARAN = "0";
    const MENUNGGU_VERIFIKASI = "1";
    const MENUNGGU_RESI = "2";
    const SEDANG_DIKIRIM = "3";
    const ORDER_SELESAI = "4";
    const DIBATALKAN = "5";
}
