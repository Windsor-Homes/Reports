<?php

namespace Lib\Reports;

class ReportNav
{
    const CONFIG_PATH = './../config/lib/Reports/Nav.php';

    private $config = [
        'stylesheets' => null,
        'templates_path' => null,
        'js_path' => null,
        'wrapper_class' => null,
        'class_map' => null
    ];

    private $labels;
    private $inputs = [
        [
            'type' => ''
        ]
    ];



    public function add()
    {

    }


}
