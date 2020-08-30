<?php

namespace App\Http\Controllers;

use App\Animalia;
use Illuminate\Http\Request;

class AnimaliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $species = Animalia::orderby('complete_name', 'asc')->select('tsn', 'complete_name')->limit(12)->get();
        } else {
            $species = Animalia::orderby('complete_name', 'asc')->select('tsn', 'complete_name')->where('complete_name', 'like', '%' . $search . '%')->limit(12)->get();
        }

        $response = array();
        foreach ($species as $specie) {
            $response[] = array(
                "id" => $specie->tsn,
                "text" => $specie->complete_name
            );
        }

        echo json_encode($response);
        exit;
    }
}
