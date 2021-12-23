<?php

namespace App\Http\Controllers;

use App\CalendarEvent;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = CalendarEvent::whereDate('event_start', '>=', $request->start)
                ->whereDate('event_end',   '<=', $request->end)
                ->get(['id', 'event_title', 'event_start', 'event_end']);
            return response()->json($data);
        }
        return view('calendars.show');
    }


    public function manageEvents(Request $request)
    {
        switch ($request->type)
        {
            case 'create':
                $calendarEvent = CalendarEvent::create([
                    'event_title' => $request->event_title,
                    'event_start' => $request->event_start,
                    'event_end' => $request->event_end,
                ]);

                return response()->json($calendarEvent);
                break;

            case 'edit':
                $calendarEvent = CalendarEvent::find($request->id)->update([
                    'event_title' => $request->event_title,
                    'event_start' => $request->event_start,
                    'event_end' => $request->event_end,
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
