<?php

if (! function_exists('admin')) {
    function admin(string $path = ''): string
    {
        return asset('admin/' . ltrim($path, '/'));
    }
}