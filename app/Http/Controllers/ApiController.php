<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    function sortString(Request $req) {
        $word = $req->word;
        $nbArr = [];
        $letters = str_split($word);

        foreach($letters as $nb) {
            if(!is_numeric($nb))
                break;
            else
                $nbArr[] = array_shift($letters);
        }

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
}
