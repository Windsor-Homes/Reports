<?php

namespace Lib\Reports ;


abstract class ReportModel
{
    protected $field_list = [];
    protected $labels = [];
    protected $prefixes = [];

    protected $parameters = [];
    protected $sorting;

    protected $aggregates;
    protected $data;


    // IDEA: maybe the data-source should be an object.
    // with specialized classes for different types of data sources.
    // i.e. csv, json, query, REST-API call, internal method call.
    protected $data_source;
    protected $data_file_path;
    protected $query;

    protected $errors;

    #======================================================

    abstract function filter();
    abstract function sort();
    abstract function fetchData();

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

    public function getLabels()
    {
        return $this->field_list;
    }
    public function setLabels(array $labels)
    {
        $this->labels = array_merge($this->labels, $labels);
        return $this;
    }
    public function label(string $column, string $label)
    {
        $this->labels[$column] = $label;
        return $this;
    }

    #======================================================

    public function setPrefixes(array $prefixes)
    {
        $this->prefixes = array_merge($this->prefixes, $prefixes);
        return $this;
    }

    public function prefixField(string $column, string $prefix)
    {
        $this->prefixes[$column] = $prefix;
        return $this;
    }

    #======================================================

    public function setFieldFormats(array $formats)
    {
        $this->field_formats = array_merge($this->field_formats, $formats);
        return $this;
    }

    public function formatField(string $column, string $format_type)
    {
        $this->field_formats[$column] = $format_type;
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

    public function columnSum(string $column)
    {
        (array)$column_list = array_column($this->data, $column) ;
        (int)$sum = array_sum($column_list) ;

        return $sum ;
    }

    public function uniqueColumnCount($column)
    {
        $column_list = array_column($this->data, $column) ;
        $column_list = array_unique($column_list) ;

        return count($column_list) ;
    }

    #======================================================

}
