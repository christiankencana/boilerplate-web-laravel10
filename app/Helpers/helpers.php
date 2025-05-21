<?php

// Custom Code, Formatting Value
if (! function_exists('formatDate')) {
    function formatDate($date) {
        return date('d-m-Y', strtotime($date));
    }
}

if (! function_exists('formatPrice')) {    
    function formatPrice($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}