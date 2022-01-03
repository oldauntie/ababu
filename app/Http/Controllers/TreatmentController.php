<?php

namespace App\Http\Controllers;

use App\Treatment;
use App\Clinic;
use App\Pet;
use App\Procedure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TreatmentController extends Controller
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
            'procedure_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $pet->pet_id])
                ->withErrors($validator);
        }


        $treatment = new Treatment([
            'procedure_id' => $request->procedure_id,
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'executed_at' => $request->executed_at == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->executed_at),
            'recall_att' => $request->recall_at == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->recall_at),
            'drug_batch' => $request->drug_batch,
            'drug_batch_expires_at' => $request->drug_batch_expires_at,
            'notes' => $request->notes,
            'print_notes' => $request->print_notes == 1 ? true : false,
        ]);

        if ($treatment->save())
        {
            $request->session()->flash('success', __('message.treatment_create_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.treatment_store_error');
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Pet $pet, Treatment $treatment)
    {

        $treatment->procedure_id = $request->procedure_id;
        $treatment->pet_id = $pet->id;
        $treatment->user_id = auth()->user()->id;

        $treatment->executed_at = $request->executed_at == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->executed_at);
        $treatment->recall_at = $request->recall_at == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->recall_at);
        $treatment->drug_batch = $request->drug_batch;
        $treatment->drug_batch_expires_at = $request->drug_batch_expires_at == null ? null : Carbon::createFromFormat(auth()->user()->locale->date_short_format, $request->drug_batch_expires_at);
        $treatment->notes = $request->notes;
        $treatment->print_notes = $request->print_notes == null ? false : true;


        if ($treatment->save())
        {
            $request->session()->flash('success', __('message.treatment_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.treatment_update_error');
        }

        return redirect()->route('clinics.visits.show', [$clinic, $pet->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Pet $pet, Treatment $treatment)
    {
        if ($treatment->delete())
        {
            Session::flash('success', __('message.treatment_destroy_success'));
        }
        else
        {
            Session::flash('success', __('message.treatment_destroy_error'));
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet]);
    }


    public function editTreatmentById(Clinic $clinic, Pet $pet, Treatment $treatment)
    {
        // load user locale
        $locale = auth()->user()->locale;

        $result = $treatment->toArray();
        // change date format
        $result['created_at'] = $treatment->created_at != null ? $treatment->created_at->format($locale->date_medium_format . " " . $locale->time_long_format) : null;
        $result['updated_at'] = $treatment->updated_at != null ? $treatment->updated_at->format($locale->date_medium_format . " " . $locale->time_long_format) : null;
        $result['executed_at'] = $treatment->executed_at != null ? $treatment->executed_at->format($locale->date_short_format) : null;
        $result['recall_at'] = $treatment->recall_at != null ? $treatment->recall_at->format($locale->date_short_format) : null;
        $result['drug_batch_expires_at'] = $treatment->drug_batch_expires_at != null ? $treatment->drug_batch_expires_at->format($locale->date_short_format) : null;

        // add procedure to results
        $result += ['procedure' => $treatment->procedure->toArray()];

        return response()->json($result);
    }


    public function createTreatmentByProcedure(Clinic $clinic, Pet $pet, Procedure $procedure)
    {
        // load user locale
        $locale = auth()->user()->locale;

        $treatment = new Treatment();
        $treatment->procedure_id = $procedure->id;

        $result = $treatment->toArray();

        // change date format
        $result['created_at'] = null;
        $result['updated_at'] = null;

        // add diagnosis to results
        $result += ['procedure' => $treatment->procedure->toArray()];

        return response()->json($result);
    }



    public function list(Clinic $clinic, Pet $pet, $problem_id = null, $return = null)
    {
        $query = Treatment::where('treatments.pet_id', '=', $pet->id)
            ->join('procedures', 'treatments.procedure_id', '=', 'procedures.id')
            ->select('treatments.*', 'procedures.term_name')
            ->orderBy('created_at', 'desc');

        $treatments = $query->get();

        if ($return == 'datatable')
        {
            return Datatables::of($treatments)
                ->make(true);
        }
    }


    public function print(Clinic $clinic, Pet $pet, Treatment $treatment = null)
    {
        $qrCurrentUrl = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate(url()->previous()));
        // return $qrcode;

        // dump($qrcode);

        // dd( $pet->owner );

        $data = [
            'title' => 'nanna !!',
            'clinic' => $clinic,
            'pet' => $pet,
            'treatment' => $treatment,
            'qrCurrentUrl' => $qrCurrentUrl,
        ];

        $pdf = PDF::loadView('treatments.print', $data);

        return $pdf->stream();
    }
}
