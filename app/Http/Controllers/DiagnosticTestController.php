<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\DiagnosticTest;
use Illuminate\Http\Request;

class DiagnosticTestController extends Controller
{
    /**
     * Display a listing of diagnostic test available (VeNom).
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Clinic $clinic)
    {
        $search = $request->search;

        if ($search == '') {
            $diagnostic_tests = DiagnosticTest::where('country_id', '=', $clinic->country_id)->orderby('term_name', 'asc')->select('id', 'term_name')->limit(5)->get();
        } else {
            $diagnostic_tests = DiagnosticTest::where('country_id', '=', $clinic->country_id)->orderby('term_name', 'asc')->select('id', 'term_name')->where('term_name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($diagnostic_tests as $diagnostic_test) {
            $response[] = array(
                "id" => $diagnostic_test->id,
                "text" => $diagnostic_test->term_name
            );
        }

        echo json_encode(["results" => $response]);

        exit;
    }
}
