<?php

if (!function_exists('get_percentage_value')) {
    /**
     * get the percentage value
     *
     * @param  float|int $number
     * @param  float|int $percentage
     * @return float|int
     */
    function get_percentage_value($number, $percentage)
    {
        return $number * $percentage / 100;
    }
}

if (!function_exists('uom_converter')) {
    /**
     * UOM converter
     * note: this is not the best implementation but I will leave it for now (it should be oop)
     *
     * @param  mixed  $value
     * @param  string $from
     * @param  string $to
     * @return mixed
     */
    function uom_converter($value, $from, $to)
    {
        if ($from == 'kg') {
            return $value * 1000;
        }

        return $value / 1000;
    }
}