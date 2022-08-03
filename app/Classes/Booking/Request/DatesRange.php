<?php

namespace App\Classes\Booking\Request;

use Carbon\Carbon;

class DatesRange extends BookingRequest
{
    /**
     * Booking max days.
     * @const int
     */
    private const MAX_DAYS = 24;

    /**
     * Перевірити чи к-сть днів між двома датами не більше 24 (заданого числа).
     *
     * @param string $start_date
     * @param string $end_date
     * @return bool
     */
    public function check(string $start_date, string $end_date): bool
    {
        $begin = new Carbon($start_date);
        $end = new Carbon($end_date);

        return $begin->diffInDays($end) <= self::MAX_DAYS;
    }
}
