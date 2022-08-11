<?php

namespace Lib\Reports;

class ReportConfig
{
    private $data_source;

    private $visual_config;

    private $filters;
    private $sorting;

    private $groups;
    private $is_grouped;
    private $grouped_by;
    private $group_parent_fields;
    private $group_collection;

    protected $field_list = [];
    protected $labels = [];
    protected $prefixes = [];

    protected $parameters = [];

    protected $aggregates;


    public function setDatasource(string $source_type)
    {
        $source_type = "Datasources\\$source_type";
        $this->data_source = new $source_type;
        return $this->data_source;
    }



    public function column(string $col_name)
    {

    }

    #======================================================

    // IDEA: i think this would be a great feature, but Im really not sure how to implement it. You would give it a list of columns to exclude from the fieldset, basically- "fetch all fields except these".
    public function excludeFields(string ...$columns){}

    #======================================================

    public function getData()
    {
        return $this->data;
    }

    #======================================================

    public function getFieldList()
    {
        return $this->field_list;
    }
    public function setFieldList(string ...$columns)
    {
        $this->field_list = $columns;
        return $this;
    }


    #======================================================

    public function setParameter(
        string $name,
        string $type,
        $default = null
    ) {
        $param['name'] = $name;
        $param['type'] = $type;
        $param['default'] = $default;

        $this->parameters[] = $param;
        return $this;
    }
    public function fillParameters(array $params)
    {
        $this->parameters = array_merge($this->parameters, $params) ;
        return $this;
    }

    #======================================================

    public function fieldConcat(
        string $label,
        string $separator,
        array $strings
    ) {

    }

    #======================================================

}
