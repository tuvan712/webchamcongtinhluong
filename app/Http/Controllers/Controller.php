<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function Insert(){
        $sql="";
        $cols_str="";
        $values_str="";
        $table_name = $_POST["table_name"];
        $keys = array_keys($_POST);
        $values = array_values($_POST);
        foreach ($_POST as $key=>$value){
            if ($key != 'table_name'){
                $cols_str = $cols_str.', '.$key; 
                $values_str = $values_str.', '.$value;
            }
        }
        $cols_str =substr($cols_str,0,strlen($cols_str) - 1);
        $values =substr($values,0,strlen($values) - 1);
        $sql = "insert into ".$table_name. "(staff_id,".$cols_str.") values (F_GET_ID('".$table_name."')," .$values.")";
        $rtn = DB::Insert($sql);
        $res = [
            "status" => $rtn ,
            "msg"    =>$rtn==1?"success":$errortext
        ]; 
        echo json_encode($res);
    }
}
