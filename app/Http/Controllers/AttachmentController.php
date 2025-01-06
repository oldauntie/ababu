<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Clinic;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Exception;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['io' => 'sono'];
        return json_encode($result);

        echo "nanna";
    }


    public function attachi(Request $request, Clinic $clinic, Examination $examination)
    {


        return "attachi";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attach(Request $request, Clinic $clinic, Examination $examination)
    {
        $request->validate([
            'attachment' => 'required|mimes:pdf,doc,docx,png,jpg,svg,txt"|max:2048',
            'description' => 'max:255',
        ]);

        # force the id creation in order to save the attchment
        $attachment_id = Str::uuid()->toString();

        $file = $examination->pet->id . '_' . $attachment_id . '.' . $request->attachment->extension();

        try {
            $request->attachment->move(public_path('attachments'), $file);
        } catch (Exception $ex) {
            $request->session()->flash('error', 'message.file_move_error');
            return json_encode(['error' => 'message.file_move_error']);
        }

        $attachment = new Attachment([
            'id' => $attachment_id,
            'examination_id' => $examination->id,
            'name' => $request->attachment->getClientOriginalName(),
            'file' => $file,
            'description' => $request->description,
        ]);

        if ($attachment->save()) {
            $request->session()->flash('success', __('message.record_store_success'));
        } else {
            $request->session()->flash('error', 'message.record_store_error');
        }

        return $attachment->toJson();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        //
    }
}
