<?php



use OpenJournalTeam\Core\Core;

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

if (!function_exists('add_style')) {
    /**
     * Add style resource to template
     */
    function add_style($href, $async = false)
    {
        return Core::addStyle($href, $async);
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
