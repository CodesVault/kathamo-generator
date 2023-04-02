<?php

namespace Kathamo\App\Services;

class Notifier
{
    const Colors = [
        'neutral'   => "\033[0m",
        'success'   => "\033[0;32m",
        'error'     => "\033[31m",
        'warning'   => "\033[33m",    
    ];

    public static function notify($msg, $type = 'success')
    {
        $neutral = static::Colors['neutral'];
        $color = static::Colors[$type];

        return "{$color}{$msg}{$neutral}\n";
    }
}
