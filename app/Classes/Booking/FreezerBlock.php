<?php

namespace App\Classes\Booking;

class FreezerBlock
{
    private int $length;
    private int $width;
    private int $heigth;

    public function __construct($length = 2, $width = 1, $heigth = 1)
    {
        $this->length = $length;
        $this->width = $width;
        $this->heigth = $heigth;
    }

    public function volume()
    {
        return $this->length * $this->width * $this->heigth;
    }
}
