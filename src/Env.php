<?php

declare(strict_types=1);

namespace Phico\Config;


class Env
{
    public function __construct()
    {
        global $_ENV;

        if (files()->exists(path('.env'))) {
            $lines = files()->lines(path('.env'));
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    list($k, $v) = explode('=', $line, 2);
                    if (preg_match('/^["\'].*["\']$/', $v)) {
                        $v = substr($v, 1, -1);
                    }
                    $_ENV[$k] = $v;
                }
            }
        }
    }
    public function __invoke(string $key, mixed $default = null): mixed
    {
        return $_ENV[$key] ?? $default;
    }
}
