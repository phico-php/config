<?php

declare(strict_types=1);

namespace Phico\Config;


class Config
{
    private array $config;

    public function __construct(string $folder = '/config', string $overrides = null)
    {
        $this->config = [];

        // parse configs
        foreach (folders()->list(path($folder)) as $file) {
            // @TODO handle folders
            $key = basename(str_replace(".php", "", $file));
            $this->config[$key] = require (path("$folder/$file"));
        }

        // parse override folder configs
        if ($overrides) {
            // load all config from overrides folder
            foreach (folders()->list(path("$folder/$overrides")) as $file) {
                $key = basename(str_replace(".php", "", $file));
                $this->config[$key] = require (path("$folder/$file"));
            }
        }
    }
    public function __invoke(string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $value = $this->config;
        foreach ($keys as $k) {
            if (is_array($value) && array_key_exists($k, $value)) {
                $value = $value[$k];
            } else {
                return $default;
            }
        }

        return $value;
    }
}
