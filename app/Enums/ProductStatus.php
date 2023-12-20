<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Active()
 * @method static static Sale()
 * @method static static Sold()
 */
final class ProductStatus extends Enum
{
    const Pending = 0;
    const Active = 1;
    const Sale = 2;
    const Sold = 3;
}
