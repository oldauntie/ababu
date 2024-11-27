<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Prescription;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
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
    public function store(Request $request, Clinic $clinic, Owner $owner, Pet $pet)
    {
        $request->validate([
            'medicine_id' => 'required',
            'prescription_date' => 'required|before:tomorrow',
            'quantity' => 'required|numeric|min:1|max:65535',
            'dosage' => 'required|max:50',
            'duration' => 'max:50',
        ]);

        $prescription = new Prescription([
            'medicine_id' => $request->medicine_id,
            'pet_id' => $pet->id,
            'problem_id' => $request->problem_id,
            'user_id' => auth()->user()->id,
            'prescription_date' => $request->prescription_date,
            'quantity' => $request->quantity,
            'dosage' => $request->dosage,
            'duration' => $request->duration,
            'in_evidence' => $request->has('in_evidence'),
            'notes' => $request->notes,
            'print_notes' => $request->has('print_notes'),
        ]);

        # save note record
        if ($prescription->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @param  \App\Models\Owner  $owner
     * @param  \App\Models\Pet  $pet
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Owner $owner, Pet $pet, Prescription $prescription)
    {
        $result = Prescription::where('id', '=', $prescription->id)
            ->with('pet')
            ->with('problem')
            ->with('medicine')
            ->first();
        return view('visits.prescriptions.show')->with('prescription', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
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
     * @param  \App\Models\Clinic  $clinic
     * @param  \App\Models\Owner  $owner
     * @param  \App\Models\Pet  $pet
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic, Owner $owner, Pet $pet, Prescription $prescription)
    {
        $request->validate([
            'prescription_date' => 'required|before:tomorrow',
            'quantity' => 'required|numeric|min:1|max:65535',
            'dosage' => 'required|max:50',
            'duration' => 'max:50',
        ]);

        # fill prescription information
        $prescription->problem_id = $request->problem_id;
        $prescription->user_id = auth()->user()->id;

        $prescription->prescription_date = $request->prescription_date;
        $prescription->quantity = $request->quantity;
        $prescription->dosage = $request->dosage;
        $prescription->duration = $request->duration;
        $prescription->in_evidence = $request->has('in_evidence');
        $prescription->notes = $request->notes;
        $prescription->print_notes = $request->has('print_notes');

        # update note info
        if ($prescription->update()) {
            $request->session()->flash('success', __('message.record_update_success'));
        } else {
            $request->session()->flash('error', 'message.record_update_error');
        }

        return redirect()->route('clinics.owners.pets.visit', [$clinic, $owner, $pet])->with('set_active_tab', __('notes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function get(Clinic $clinic, Prescription $prescription)
    {
        $result = Prescription::where('id', '=', $prescription->id)
            ->with('problem')
            ->with('medicine')->first();
        return $result->toJson();
    }


    public function print(Clinic $clinic, Prescription $prescription = null)
    {
        // dd($prescription->pet->owner);
        // $qrcode = QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string');
        $qrCurrentUrl = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate( url()->previous() ));
        // return $qrcode;

        // dump($qrcode);

        // dd( $pet->owner );
   
        $data = [
            'title' => 'nanna !!',
            'clinic' => $clinic,
            'prescription' => $prescription,
            'qrCurrentUrl' => $qrCurrentUrl,
            ];
            
        $pdf = PDF::loadView('visits.prescriptions.print', $data);
        
        return $pdf->stream();
    }
}
