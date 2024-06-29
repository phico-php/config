<?php

declare(strict_types=1);

// these functions cannot be overridden at the moment
function config(): mixed
{
    static $config;
    $config = ($config) ? $config : new \Phico\Config\Config();
    return $config;
}
function env(string $name, mixed $default = null): mixed
{
    static $env;
    $env = ($env) ? $env : new \Phico\Config\Env();
    return $env($name, $default);
}
