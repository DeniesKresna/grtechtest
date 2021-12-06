<?php
namespace App\Traits;

use DataTables;

trait Helper {

    /**
     * render common datatable.
     * 
     * @param \Illuminate\Database\Eloquent\Collection|static[] $data
     * @param array|mixed $pictureConfig
     * @param array|mixed $additionalColumn
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTable($data, $pictureConfig=[], $additionalColumn=[]){
        $columns = ['action'];
        $datatable = \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                    $btn = '<a href="#" onClick="showEditModal('.$row->id.')" class="edit btn btn-primary btn-sm">'.__('table.label_view').'</a>';
                    $btn .= '<a href="#" onClick="deleteData('.$row->id.')" class="edit btn btn-danger btn-sm">'.__('table.label_delete').'</a>';

                    return $btn;
            });

        if(count($pictureConfig) > 0){
            if(array_key_exists('columnName',$pictureConfig) && array_key_exists('photoField',$pictureConfig)){
                if($pictureConfig['photoField'] != ''){
                    $photoField = $pictureConfig['photoField'];
                    $datatable = $datatable->addColumn($pictureConfig['columnName'], function($row) use($photoField){
                        $picture = '';
                        if($row->{$photoField}){
                            $picture = '<img src="'.asset('storage/company/'.$row->{$photoField}).'" width="75" />';
                        }
                        return $picture;
                    });
                    array_push($columns, $pictureConfig['columnName']);
                }
            }
        }

        if(count($additionalColumn) > 0){
            foreach($additionalColumn as $config){
                if($config != ""){
                    $columnName = $config;
                    $datatable = $datatable->addColumn($config, function($row) use($columnName){
                        return $row->{$columnName};
                    });
                    array_push($columns, $columnName);
                }
            }
        }

        return $datatable->rawColumns($columns)
                ->make(true);
    }
}