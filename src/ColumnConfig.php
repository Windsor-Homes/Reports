<?php

namespace Lib\Reports;

class ColumnConfig
{
    private $name;
    private $label;
    private $prefix;
    private $format;
    private $filters;
    private $sort;

    #======================================================

    public function name(string $name)
    {
        $this->name = $name;
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


}
