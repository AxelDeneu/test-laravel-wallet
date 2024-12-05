<?php

declare(strict_types=1);

if (! function_exists('currency_amount')) {
    function currency_amount(int|float $number, string $in = '', ?string $locale = null): false|string
    {
        return \Illuminate\Support\Number::currency((int) $number / 100, $in, $locale);
    }
}
