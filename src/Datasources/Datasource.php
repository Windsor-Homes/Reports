<?php

namespace Lib\Reports;

interface Datasource
{
    public function fetchData();
    public function generate();
}
