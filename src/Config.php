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
        foreach (folders(path($folder))->list() as $file) {
            // @TODO handle folders
            $key = basename(str_replace(".php", "", $file));
            $this->config[$key] = require (path("$folder/$file"));
        }

        // parse override folder configs
        if ($overrides) {
            // load all config from overrides folder
            foreach (folders(path("$folder/$overrides"))->list() as $file) {
                $key = basename(str_replace(".php", "", $file));
                $this->config[$key] = require (path("$folder/$file"));
            }
        }
    }
    // #[\Deprecated]
    public function __invoke(string $key, mixed $default = null): mixed
    {
        return $this->get($key, $default);
    }
    public function get(string $key, mixed $default = null): mixed
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
    public function set(string $key, mixed $value): self
    {
        $config = &$this->config;

        $keys = explode('.', $key);
        $last = array_pop($keys);
        foreach ($keys as $k) {
            if (!isset($config[$k])) {
                $config[$k] = [];
            }
            $config = &$config[$k];
        }

        $config[$last] = $value;
        return $this;
    }
}
