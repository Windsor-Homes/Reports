<?php

namespace src\Framework\Reports ;

use src\Cleaners\Cleaner ;

trait DateFilters
{


    public function filterDateInterval($field, $interval, $unit)
    {
        if ($interval < 0) {
            $mysql_func = 'DATE_SUB' ;
        }
        elseif ($interval > 0) {
            $mysql_func = 'DATE_ADD' ;
        }

        return "$mysql_func($field)"

    }

    public function filterBeforeDateInterval($field, $expr, $unit)
    {
        return "`field` BETWEEN" ;
    }

    public function filterBetweenDates($field, $start_date, $end_date)
    {
        return "`$field` BETWEEN '$start_date' AND '$end_date'" ;
    }

    public function filterBeforeDate($field, $date)
    {
        return "$field < '$date'" ;
    }

    public function filterAfterDate($field, $date)
    {
        return "$field > '$date'" ;
    }

}
