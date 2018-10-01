<?php
/**
 * Created by Aatish Gore.
 * Company: Neosoft
 * Date: 29/9/18
 * Time: 1:37 PM
 */

if (! function_exists('application_date_format')) {
    function application_date_format($date, $format = 'd-m-Y') {
        return Carbon\Carbon::parse($date)->format($format);
    }
}