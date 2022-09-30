<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    function sortString(Request $req) {
        //get string
        $word = $req->word;
        // array that will contain the numbers of the string
        $nbArr = [];
        $letters = str_split($word);
        // sort with respect to lower and upper cases
        natcasesort($letters);

        // natcasesort sorts number at first so we will loop through the array to take numbers(and delete them from original array) and once we reach a char that is not a number it will break 
        foreach($letters as $nb) {
            if(!is_numeric($nb))
                break;
            else
                $nbArr[] = array_shift($letters);
        }
        // natcasesort prefers uppercase char over lowercase so we substitute them to get what we want.
        for($i=0;$i<sizeof($letters)-1;$i++) {
            $j = $i + 1;
            if(strtolower($letters[$i]) === $letters[$j]) {
                $temp = $letters[$i];
                $letters[$i] = $letters[$j];
                $letters[$j] = $temp;
            }
        }

        foreach($nbArr as $nb) {
            $letters[] = $nb;
        }

        return response()->json([$word => implode($letters)]);
    }


    function breakNumber(Request $req) {
        $word = $req->number;
        $number = str_split($word);
        $i = 0;
        if($number[0] === '-') {
            $x = 1;
            $is_negative = true;
        }else {
            $x = 0;
            $is_negative = false;
        }
        $newArr = [];
        for($i=$x;$i<sizeof($number);$i++) {
            $number[$i] = $number[$i] * pow(10, sizeof($number) - 1 - $i);
            if($is_negative)
                $newArr[] = - $number[$i];
            else
                $newArr[] = $number[$i];
        }

        return response()->json([$word => $newArr]);
    }
}
