<?php

namespace Modules\CongregateTheme\Services;

class PageAsset {

    private static $js = [];
    private static $css = [];

    /**
     * Resets the list of external Javascript files
     */
    public static function resetJs()
    {
        self::$js = [];
    }

    /**
     * Resets the list of external CSS files
     */
    public static function resetCss()
    {
        self::$css = [];
    }

    /**
     * Add an external javascript file path
     *
     * @param string $path The path to the file
     * @param string|number $id unique identifier for this file
     */
    public static function js(string $path, $id = null)
    {
        $id = $id ?? md5($path);
        self::$js[$id] = $path;
    }

    /**
     * Add an external css file path
     *
     * @param string $path The path to the file
     * @param string|number $id unique identifier for this file
     */
    public static function css(string $path, $id = null)
    {
        $id = $id ?? md5($path);
        self::$css[$id] = $path;
    }

    /**
     * Returns javascript html tags for each file
     */
    public static function renderJs()
    {
        $content = '';
        foreach(self::$js as $path) {
            $content .= "<script src=\"{$path}\"></script>";
        }

        return $content;
    }

    /**
     * Returns css html tags for each file
     */
    public static function renderCss()
    {
        $content = '';
        foreach(self::$css as $path) {
            $content .= "<link rel=\"stylesheet\" href=\"{$path}\">";
        }

        return $content;
    }
}
