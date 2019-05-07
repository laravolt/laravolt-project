<?php

namespace Laravolt\Cms\Models\Concerns;

trait Shortcode
{
    public static $shortcodes = [];

    public static function registerShortcode($name, $handler)
    {
        if (!is_callable($handler)) {
            if (is_string($handler) && class_exists($handler)) {
                $handler = new $handler;
            }
        }
        static::$shortcodes[$name] = $handler;
    }
}
