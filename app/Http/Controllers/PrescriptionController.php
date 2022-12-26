<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Clinic;
use App\Pet;
use App\Medicine;
use App\Problem;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PrescriptionController extends Controller
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
            'quantity' => 'required',
            'dosage' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $pet->pet_id])
            ->withErrors($validator);
        }

        $prescription = new Prescription([
            'medicine_id' => $request->medicine_id,
            'problem_id' => $request->problem_id,
            'pet_id' => $pet->id,
            'user_id' => auth()->user()->id,
            'quantity' => $request->quantity,
            'dosage' => $request->dosage,
            'duration' => $request->duration,
            'in_evidence' => $request->in_evidence == 1 ? true : false,
            'notes' => $request->notes,
            'print_notes' => $request->print_notes == 1 ? true : false,
        ]);

        if ($prescription->save())
        {
            $request->session()->flash('success', __('message.prescription_create_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.prescription_store_error');
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Pet $pet, Prescription $prescription)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            'dosage' => 'required',
        ]);

        
        if ($validator->fails())
        {
            return redirect()->route('clinics.visits.show', [$clinic, $prescription->pet_id])
            ->withErrors($validator);
        }
        
        $prescription->problem_id = $request->problem_id;
        $prescription->user_id = auth()->user()->id;
        $prescription->quantity = $request->quantity;
        $prescription->dosage = $request->dosage;
        $prescription->duration = $request->duration;
        $prescription->in_evidence = $request->in_evidence == null ? false : true;
        $prescription->notes = $request->notes;
        $prescription->print_notes = $request->print_notes == null ? false : true;


        if ($prescription->save())
        {
            $request->session()->flash('success', __('message.prescription_update_success'));
        }
        else
        {
            $request->session()->flash('error', 'message.prescription_update_error');
        }

        return redirect()->route('clinics.visits.show', [$clinic, $prescription->pet_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic, Pet $pet, Prescription $prescription)
    {
        if($prescription->delete())
        {
            Session::flash('success', __('message.prescription_destroy_success'));
        }
        else
        {
            Session::flash('success', __('message.prescription_destroy_error'));
        }
        return redirect()->route('clinics.visits.show', [$clinic, $pet]);
    }


    public function createPrescriptionByMedicine(Clinic $clinic, Pet $pet, Medicine $medicine, Problem $problem = null)
    {
        // load user locale
        $locale = auth()->user()->locale;

        $prescription = new Prescription();
        $prescription->problem_id = $problem == null ? null : $problem->id;
        $prescription->medicine_id = $medicine->id;

        $result = $prescription->toArray();

        // change date format
        $result['date_of_prescription'] = Carbon::now()->format($locale->date_short_format);
        $result['created_at'] = null;
        $result['updated_at'] = null;
        
        // add diagnosis to results
        $result += ['medicine' => $prescription->medicine->toArray()];

        return response()->json($result);
    }


    public function editPrescriptionById(Clinic $clinic, Pet $pet, Prescription $prescription)
    {
        // load user locale
        $locale = auth()->user()->locale;

        /*
        $prescription = Prescription::where('id', '=', $prescription->id)
            ->where('pet_id', '=', $pet->id)
            ->first();
        */

        $result = $prescription->toArray();

        // change date format
        $result['date_of_prescription'] = $prescription->created_at->format($locale->date_short_format);
        $result['created_at'] = $prescription->created_at->format($locale->date_short_format . ' ' . $locale->time_long_format);
        $result['updated_at'] = $prescription->updated_at != null ? $prescription->updated_at->format($locale->date_short_format . ' ' . $locale->time_long_format) : null;
        
        // add diagnosis to results
        $result += ['medicine' => $prescription->medicine->toArray()];

        return response()->json($result);
    }


    public function list(Clinic $clinic, Pet $pet, $problem_id = null, $return = null)
    {
        $query = Prescription::where('prescriptions.pet_id', '=', $pet->id)
            ->join('medicines', 'prescriptions.medicine_id', '=', 'medicines.id')
            ->select('prescriptions.*', 'medicines.name')
            ->orderBy('in_evidence', 'desc')
            ->orderBy('created_at', 'desc');

        if ($problem_id != null && $problem_id > 0)
        {
            $query->where('problem_id', '=', $problem_id);
        }
        $prescriptions = $query->get();

        if ($return == 'datatable')
        {
            return Datatables::of($prescriptions)
                ->make(true);
        }
    }



    public function print(Clinic $clinic, Pet $pet, Prescription $prescription = null)
    {
        // $qrcode = QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string');
        $qrCurrentUrl = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate( url()->previous() ));
        // return $qrcode;

        // dump($qrcode);

        // dd( $pet->owner );
   
        $data = [
            'title' => 'nanna !!',
            'clinic' => $clinic,
            'pet' => $pet,
            'prescription' => $prescription,
            'qrCurrentUrl' => $qrCurrentUrl,
            ];
            
        $pdf = PDF::loadView('prescriptions.print', $data);
        
        return $pdf->stream();
    }
}
