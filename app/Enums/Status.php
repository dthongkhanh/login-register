<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The Status enum.
 *
 * @method static self PENDING()
 * @method static self COMPLETED()
 * @method static self PAST_DUE()
 */
class Status extends Enum
{
    const PENDING = 1;
    const COMPLETED = 2;
    const PAST_DUE = 3;

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function map() : array
    {
        return [
            static::PENDING => 'Pending',
            static::COMPLETED => 'Completed',
            static::PAST_DUE => 'Past due',
        ];
    }
}
