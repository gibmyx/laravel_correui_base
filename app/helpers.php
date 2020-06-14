<?php
if (!function_exists('isEmpty')) {
    /**
     * @param $value
     * @return bool
     */
    function isEmpty($value)
    {
        if ($value instanceof Countable) {
            return !count($value);
        } else if ($value instanceof \Illuminate\Database\Eloquent\Collection) {
            return $value->isEmpty();
        }

        return empty($value);
    }
}

if (!function_exists('ddd')) {
    function ddd(...$args)
    {
        http_response_code(500);
        call_user_func_array('dd', $args);
    }
}


if (!function_exists('curreny')) {
    function curreny($value = 0, $prefix = '$')
    {
        return $prefix . number_format($value, 2);
    }
}

if (!function_exists('currency4')) {
    function currency4($value = 0, $prefix = '$')
    {
        return $prefix . number_format($value, 4);
    }
}


if (!function_exists('round_up')) {
    /**
     * retorna el numero redondeado mayor igual a 5.
     *
     * @param string $numero
     * @param integer $presicion
     * @return float
     */
    function round_up($numero = 0, $presicion = 2)
    {
        return round($numero, $presicion, PHP_ROUND_HALF_UP);
    }
}


if (!function_exists('round_down')) {
    /**
     * retorna el numero redondeado menor igual a 5.
     *
     * @param string $make
     * @param integer $presicion
     * @return float
     */
    function round_down($numero = 0, $presicion = 2)
    {
        return round($numero, $presicion, PHP_ROUND_HALF_DOWN);
    }
}
