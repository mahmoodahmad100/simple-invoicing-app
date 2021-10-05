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