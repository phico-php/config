<?php

use Phico\Config\Config;

test('can set and get a simple value', function () {

    $config = new Config('tests/config');
    $config->set('foo', 'bar');

    expect($config->get('foo'))->toBe('bar');
});

test('returns default value if key does not exist', function () {

    $config = new Config('tests/config');

    expect($config->get('nonexistent', 'default'))->toBe('default');
});

test('can set and get a nested value', function () {

    $config = new Config('tests/config');
    $config->set('one.two.three', 'xyz');

    expect($config->get('one.two.three'))->toBe('xyz');
});

test('does not overwrite existing values at the same level', function () {

    $config = new Config('tests/config');
    $config->set('one.foo', 'bar');
    $config->set('one.two.three', 'xyz');

    expect($config->get('one.foo'))->toBe('bar');
    expect($config->get('one.two.three'))->toBe('xyz');
});

test('can handle deeply nested values', function () {

    $config = new Config('tests/config');
    $config->set('a.b.c.d.e.f.g', 'deep');

    expect($config->get('a.b.c.d.e.f.g'))->toBe('deep');
});

test('returns default value for non-existent nested keys', function () {

    $config = new Config('tests/config');
    expect($config->get('a.b.c', 'not found'))->toBe('not found');

});
