<?php

namespace blog\app;

class Http
{

    public static function redirect (string $url): void
    {
        header("Location: $url");
        exit();
    }
}