<?php

namespace App\Http\Controllers;

use App\Examination;
use App\Clinic;
use App\DiagnosticTest;
use App\Pet;
use App\Problem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Clinic $clinic, Pet $pet)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'diagnostic_test_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $pet->pet_id])
                ->withErrors($validator);
        }


        $examination = new Examination([
            'diagnostic_test_id' => $request->diagnostic_test_id,
            'problem_id' => $request->problem_id,
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'result' => $request->result,
            'medical_report' => $request->medical_report,
            'is_pathologic' => $request->is_pathologic == 1 ? true : false,
            'in_evidence' => $request->in_evidence == 1 ? true : false,
            'notes' => $request->notes,
            'print_notes' => $request->print_notes == 1 ? true : false,
        ]);


        if ($examination->save())
        {
            $request->session()->flash('success', __('message.examination_create_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.examination_store_error');
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function show(Examination $examination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function edit(Examination $examination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Pet $pet, Examination $examination)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'diagnostic_test_id' => 'required',
        ]);


        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $examination->pet_id])
                ->withErrors($validator);
        }

        $examination->diagnostic_test_id = $request->diagnostic_test_id;
        $examination->problem_id = $request->problem_id;
        $examination->user_id = auth()->user()->id;
        $examination->result = $request->result;
        $examination->medical_report = $request->medical_report;
        $examination->is_pathologic = $request->is_pathologic == null ? false : true;
        $examination->in_evidence = $request->in_evidence == null ? false : true;
        $examination->notes = $request->notes;
        $examination->print_notes = $request->print_notes == null ? false : true;


        if ($examination->save())
        {
            $request->session()->flash('success', __('message.examination_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.examination_update_error');
        }

        return redirect()->route('clinics.visits.show', [$clinic, $examination->pet_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Examination  $examination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Pet $pet, Examination $examination)
    {
        if($examination->delete())
        {
            Session::flash('success', __('message.examination_destroy_success'));
        }
        else
        {
            Session::flash('success', __('message.examination_destroy_error'));
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet]);
    }


    public function createExaminationByDiagnosticTest(Clinic $clinic, Pet $pet, DiagnosticTest $diagnosticTest, Problem $problem = null)
    {
        // load user locale
        $locale = auth()->user()->locale;

        $examination = new Examination();
        $examination->problem_id = $problem == null ? null : $problem->id;
        $examination->diagnostic_test_id = $diagnosticTest->id;

        $result = $examination->toArray();

        // change date format
        $result['date_of_examination'] = Carbon::now()->format($locale->date_short_format);
        $result['created_at'] = null;
        $result['updated_at'] = null;
        
        // add diagnosis to results
        $result += ['diagnostic_test' => $examination->diagnosticTest->toArray()];

        return response()->json($result);
    }


    public function editExaminationById(Clinic $clinic, Pet $pet, Examination $examination)
    {
        // load user locale
        $locale = auth()->user()->locale;

        /*
        $prescription = Prescription::where('id', '=', $prescription->id)
            ->where('pet_id', '=', $pet->id)
            ->first();
        */

        $result = $examination->toArray();

        // change date format
        $result['date_of_examination'] = $examination->created_at->format($locale->date_short_format);
        $result['created_at'] = $examination->created_at->format($locale->date_short_format . ' ' . $locale->time_long_format);
        $result['updated_at'] = $examination->updated_at != null ? $examination->updated_at->format($locale->date_long_format . ' ' . $locale->time_long_format) : null;

        // add diagnosis to results
        $result += ['diagnostic_test' => $examination->diagnosticTest->toArray()];

        return response()->json($result);
    }


    public function list(Clinic $clinic, Pet $pet, $problem_id = null, $return = null)
    {
        $query = Examination::where('examinations.pet_id', '=', $pet->id)
            ->join('diagnostic_tests', 'examinations.diagnostic_test_id', '=', 'diagnostic_tests.id')
            ->select('examinations.*', 'diagnostic_tests.term_name')
            ->orderBy('in_evidence', 'desc')
            ->orderBy('created_at', 'desc');

        if ($problem_id != null && $problem_id > 0)
        {
            $query->where('problem_id', '=', $problem_id);
        }
        $examinations = $query->get();

        if ($return == 'datatable')
        {
            return Datatables::of($examinations)
                ->make(true);
        }
    }


    public function print(Clinic $clinic, Pet $pet, Examination $examination = null)
    {
        $qrCurrentUrl = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate(url()->previous()));
        // return $qrcode;

        // dump($qrcode);

        // dd( $pet->owner );

        $data = [
            'clinic' => $clinic,
            'pet' => $pet,
            'examination' => $examination,
            'qrCurrentUrl' => $qrCurrentUrl,
        ];

        $pdf = PDF::loadView('examinations.print', $data);

        return $pdf->stream();
    }
}
