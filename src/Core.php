<?php

namespace OpenJournalTeam\Core;

use Illuminate\Support\HtmlString;

class Core
{
    public static function renderScript()
    {
        $scripts = config('core.scripts');

        $scripts = apply_filters('Core::scripts', $scripts);

        $html = '';

        foreach ($scripts as $script) {
            $defer = $script['defer'] ? 'defer ' : '';

            $html .= new HtmlString('<script ' . $defer . "src='" . asset($script['src']) . "'></script>" . PHP_EOL);
        }

        return $html;
    }

    public static function addScript(string | array $src, $defer = false)
    {
        add_filter('Core::scripts', function ($scripts) use ($src, $defer) {
            if (is_array($src)) {
                $scripts[] = $src;
            }

            $scripts[] = [
                'src' => $src,
                'defer' => $defer,
            ];

            return $scripts;
        });
    }

    public static function renderStyle()
    {
        $styles = config('core.styles');

        $styles = apply_filters('Panelbackend::styles', $styles);

        $html = '';

        foreach ($styles as $style) {
            if ($style['async']) {
                $html .= new HtmlString("<link rel='preload' as='style' href='" . asset($style['href']) . "' onload='this.onload=null;this.rel=`stylesheet`'>" . PHP_EOL);
                continue;
            }

            $html .= new HtmlString("<link rel='stylesheet' href='" . asset($style['href']) . "'>" . PHP_EOL);
        }

        return $html;
    }

    public static function addStyle(string | array $href, $async = false)
    {
        add_filter('Panelbackend::styles', function ($styles) use ($href, $async) {
            if (is_array($href)) {
                $styles[] = $href;
            }

            $styles[] = [
                'href' => $href,
                'async' => $async,
            ];

            return $styles;
        });
    }
}
