<?php

namespace App\Http\Controllers;

use App\CalendarEvent;
use App\Clinic;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class CalendarEventController extends Controller
{
    public function events(Request $request)
    {
        if($request->ajax()){
            Log::info( "AJAX" );
        }

        // Log::info( $request );
        $data = CalendarEvent::get(['id', 'title', 'start', 'end']);
        // $data = CalendarEvent::get('event_start');
        
        Log::info( $data->toJson() );

        /*
        $data = "[
            {
              title  : 'event3',
              start  : '2021-12-09T12:30:00',
              allDay : false // will make the time show
            }
          ]";
        */
        // echo $data;
        return $data->toJson();
    }
    
    public function show(Request $request, Clinic $clinic)
    {
        
        if ($request->ajax())
        {
            $data = CalendarEvent::whereDate('event_start', '>=', $request->start)
            ->whereDate('event_end',   '<=', $request->end)
            ->get(['id', 'event_title', 'event_start', 'event_end']);
            Log::info( response()->json($data) );

            return response()->json($data);
        }
        return view('calendars.show')->with('clinic', $clinic);
    }


    public function manage(Request $request, Clinic $clinic)
    {
        switch ($request->type)
        {
            case 'create':
                $calendarEvent = CalendarEvent::create([
                    'clinic_id' => $clinic->id,
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($calendarEvent);
                break;

            case 'edit':
                $calendarEvent = CalendarEvent::find($request->id)->update([
                    // 'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($calendarEvent);
                break;

            case 'delete':
                $calendarEvent = CalendarEvent::find($request->id)->delete();

                return response()->json($calendarEvent);
                break;

            default:
                break;
        }
    }
}
