<?php

use Illuminate\View\Component;
use OpenJournalTeam\Core\Core;

if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists('getDirContents')) {
    function getDirContents($dir, $includeHiddenFiles = false, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            if (!$includeHiddenFiles) {
                if (strpos($value, '.') === 0) continue;
            }
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }
}

if (!function_exists('render')) {
    /**
     * Render the template Backend
     *
     * @param  array  $mergeData
     */
    function render(?string $view = null, array $data = [], array $mergeData = [], ?string $template = 'core::template.default')
    {
        $meta['view'] = $view;
        $meta['data'] = $data;
        $meta['mergeData'] = $mergeData;

        return view($template, $meta, $mergeData);
    }
}

if (!function_exists('render_livewire')) {
    function render_livewire($view)
    {
        return view($view)
            ->extends('core::template.index')
            ->section('content');
    }
}

if (!function_exists('render_component')) {
    function render_component(Component $component)
    {
        return $component->render()->with($component->data());
    }
}

if (!function_exists('add_module_style')) {
    function add_module_style($href, $async = false)
    {
        $href = 'modules/' . $href;
        return Core::addStyle($href, $async);
    }
}

if (!function_exists('add_style')) {
    /**
     * Add style resource to template
     */
    function add_style($href, $async = false)
    {
        return Core::addStyle($href, $async);
    }
}

if (!function_exists('add_module_script')) {
    function add_module_script($src, $defer = false)
    {
        $src = 'modules/' . $src;
        return Core::addScript($src, $defer);
    }
}

if (!function_exists('add_script')) {
    /**
     * Add style resource to template
     */
    function add_script($src, $defer = false)
    {
        return Core::addScript($src, $defer);
    }
}

if (!function_exists('response_success')) {
    function response_success($data = [])
    {
        if (!is_array($data)) {
            $data = [
                'msg' => $data,
            ];
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}

if (!function_exists('response_error')) {
    function response_error($error, $status_code = 422)
    {
        return response()->json([
            'success' => false,
            'error' => $error
        ], $status_code);
    }
}

if (!function_exists('current_user_roles')) {
    function current_user_roles()
    {
        return auth()->user()->roles;
    }
}

if (!function_exists('currency_format')) {
    function currency_format($number, $decimals = 0, $prefix = false)
    {
        $hadValue   = ($number != 0 && !is_null($number));
        $integer    = !$hadValue ? 0 : number_format($number, $decimals, '.', ',');
        return $prefix ? ($hadValue ? $prefix . $integer : $number) : $integer;
    }
}