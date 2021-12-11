<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait ModelHelper
{
    public function filterModel(Builder $builder, Model $model)
    {
        $data = request()->all();
        $filterable = $model->filterable;
        $filter_columns = [];

        foreach($data as $key => $value){
            if(in_array($key,$filterable)){
                array_push($filter_columns,$key);
            }
        }

        if(count($filter_columns)> 0){
            for($i=0; $i<count($filter_columns); $i++){
                if($data[$filter_columns[$i]] == "") continue;

                $mode = "where";
                
                if($this->ends_with($filter_columns[$i],"_id") || $filter_columns[$i] == "id"){
                    $filter_string = $data[$filter_columns[$i]];
                }else{
                    $filter_string = '%'.$data[$filter_columns[$i]].'%';
                }
                $builder->$mode($filter_columns[$i], 'like', $filter_string);
            }
        }
    }

    private function ends_with( $haystack, $needle ) {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }
}