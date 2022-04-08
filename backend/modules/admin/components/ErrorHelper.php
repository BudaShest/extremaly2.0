<?php

namespace app\modules\admin\components;

class ErrorHelper
{
    public static function format($errors){
        $output = '';
        foreach ($errors as $key => $error){
            $output .= $key . ' : ' . '{';
            foreach ($error as $currentError){
                $output .= $currentError . ', ';
            }
            $output .= '}';
        }
       return $output;
    }
}