<?php

return [


  'enabled' => env('CORE_ENABLED', true),
  'cache' => [
    'enable' => true,
    'time' => 60 * 60 * 24,
  ],

  /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Panel Backend route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

  'middleware' => [
    'web',
  ],

  /*
    |--------------------------------------------------------------------------
    | Panel Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Panel will be accessible from. Feel free
    | to change this path to anything you like. 
    |
    */

  'title' => env('CORE_TITLE', 'Panel'),

  'path' => env('CORE_PATH', 'panel'),

  'scripts' => [
    [
      'src' => 'vendor/core/libs/swal/sweetalert2.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/pusher/pusher.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/alpinejs/alpinejs3.min.js',
      'defer' => true
    ],
    [
      'src' => 'vendor/core/libs/datatables/datatables.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/datatables/dataTables.bootstrap5.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/select2/select2.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/datatables/responsive/js/dataTables.responsive.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/dropzone/dropzone.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/app.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/form.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/swal.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/alpine.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/datatables.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/dropzones.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/select2.js',
      'defer' => false
    ],
  ],

  'styles' => [
    [
      'href' => 'vendor/core/css/tabler.min.css',
      'async' => false,
    ],
    [
      'href' => 'vendor/core/css/tabler-flags.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/css/tabler-vendors.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/bootstrap-extension/bootstrap-extension.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/css/app.css',
      'async' => false,
    ],
    [
      'href' => 'vendor/core/libs/swal/sweetalert2.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/datatables/dataTables.bootstrap5.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/datatables/responsive/css/responsive.bootstrap5.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/select2/select2.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/select2/select2.bootstrap5.min.css',
      'async' => true,
    ],
    [
      'href' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
      'async' => true,
    ],
  ]

];
