<?php

declare(strict_types=1);

namespace Phico\Config;


class Env
{
    public function __construct()
    {
        global $_ENV;

        // load default env files
        $file = files(path('.env'));

        if ($file->exists()) {
            $lines = $file->lines();
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
