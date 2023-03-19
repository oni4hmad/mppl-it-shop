<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TechnicianStatus extends Enum
{
    const TERSEDIA = '0';
    const MENUNGGU_KONFIRMASI = '1';
    const DALAM_SERVIS = '2';
}
