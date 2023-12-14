<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Blocked()
 * @method static static Active()
 * @method static static Pending()
 */
final class PostStatus extends Enum
{
    const Blocked = 0;
    const Active = 1;
    const Pending = 2;
}
