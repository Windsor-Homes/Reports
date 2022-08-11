<?php

namespace Lib\Reports ;

require_once './../Lib/Utils/ArrayOps.php' ;
use \Lib\Utils\ArrayOps ;


class ReportHelper
{
    // static public function groupBy(
    //     array $data_set,
    //     string $column
    // ): array {
    //
    //     (array) $grouped_data = [] ;
    //     (array) $column_list = array_column($data_set, $column) ;
    //
    //     foreach ($column_list as $group_value) :
    //
    //         $group = [] ;
    //         foreach ($data_set as $row) :
    //             if ($row[$column] == $group_value) {
    //                 $group[] = $row ;
    //             }
    //         endforeach ;
    //
    //         $grouped_data[$group_value] = $group ;
    //     endforeach ;
    //
    //     return $grouped_data ;
    // }

    static public function groupBy(
        array $children,
        array $parents,
        string $key
    ) {
        foreach ($parents as $i => $parent) :
            foreach ($children as $child) :
                if ($parent[$key] == $child[$key]) {
                    $parents[$i]['children'][] = $child ;
                }
            endforeach ;
        endforeach ;

        return $parents ;
    }


    public function columnSum(array $data)
    {
        if ( $this->section == 'overview' || $this->section == 'builder' ) {
            $this->totals['com'] = count( $this->com_map ) ;
            $this->totals['house'] = count( $this->house_map ) ;
            $this->totals['item'] = array_sum(array_column($this->house_map , 'order_count')) ;
        }

        elseif ( $this->section == 'house' ) {
            $this->totals['item'] = count( $this->order_map ) ;
        }

        foreach ( $this->com_map as $com_id => &$com_arr ) :

            $com_house_arr = ArrayOps::column_preg_grep(
                $this->house_map ,
                'com_id' ,
                "/^$com_id$/"
            ) ;

            $com_arr['house_count'] = count( $com_house_arr ) ;
            $com_arr['order_count'] = array_sum(
                array_column($com_house_arr, 'order_count')
            ) ;

        endforeach ;
    }



    static public function extractEntity(array $data_set, $key_column, array $fields)
    {
        $fields[] = $key_column ;

        $entity = ArrayOps::sliceColumns($data_set, ...$fields) ;
        $entity = ArrayOps::uniqueColumn($entity, $key_column) ;

        return $entity ;
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



    public function removeSpecFields($arr, ...$fields)
    {
        foreach ($arr as $key => $value):
            if ( key_exists($key, $fields) ) {
                unset($arr[$key]) ;
            }
        endforeach ;
        return $arr ;
    }


    public function defineGroup(string $group_key, string ...$parent_fields)
    {
        $this->is_grouped = true ;

        $this->groups[] = [
            'group_name' => $name,
            'unique_key' => $key,
            'group_fields' => $parent_fields,
            'child_group_name' => $child_group
        ] ;


        $parent_fields[] = $group_key ;
        $this->group_parent_fields = $parent_fields ;
    }



    public function groupBy() {
        (array) $grouped_data = [] ;
        (array) $column_list = array_column($this->data_set, $group_key) ;

        $parent_fields[] = $group_key ;

        foreach ($column_list as $group_value) :

            $group = [] ;
            foreach ($this->data_set as $row) :

                if ($row[$group_key] != $group_value) {
                    continue ;
                }



                $group['children'] = $row ;

            endforeach ;

            $grouped_data[] = $group ;
        endforeach ;

        return $grouped_data ;
    }


}
