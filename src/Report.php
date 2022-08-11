<?php

namespace Lib\Reports;

class Report
{
    private $data_set ;

    

    #======================================================

    protected $config;



    
    protected $data;

    

    protected $errors;

    #======================================================

    abstract function filter();
    abstract function sort();
    abstract function fetchData();

    #======================================================

    public function prepare()
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


}
