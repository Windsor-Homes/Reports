<?php

namespace src\Framework\Reports ;

abstract class ReportController
{
    protected $filter_form_config ;
    protected $sort_form_config ;


    abstract public function __construct() ;


    public function run()
    {
        $this->addFilter() ;
        $this->addSorting() ;

        


    }










}
