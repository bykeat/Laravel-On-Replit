<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventApiController extends Controller
{
    /**
     * List all events.
     * @return string
     */
    public function list()
    {

        $events = Event::all();

        return $events->toJson();
    }

    /**
     * List active events.
     * @return string
     */
    public function list_active()
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $events = DB::table('events')
            ->where(
                "start_at",
                ">=",
                $currentDateTime
            )
            ->where(
                "end_at",
                "<=",
                $currentDateTime
            )
            ->get();
        return $events->toJson();
    }

    /**
     * Create an event
     */
    public function create(Request $request)
    {
        $this->authorize('create');
        Event::create($request->all());
        return redirect(route('events.index'));
    }

    /**
     * Save an event
     */
    public function update(Request $request, $eventId)
    {
        /** @var Event */
        $event = Event::find($eventId);
        if (!$event) {
            $this->authorize('create');
            Event::create($request->all());
        } else {
            $this->authorize('update');
            $event->save($request->all());
        }

        return redirect(route('events.index'));
    }

    /**
     * Update an event
     */
    public function partial_update(Request $request, $eventId)
    {
        $this->authorize('update');

        /** @var Event */
        $event = Event::find($eventId);
        if (isset($event)) {
            $event->update($request->all());
        }

        return redirect(route('events.index'));
    }

    /**
     * Show an event
     */
    public function view($id)
    {
        return Event::where("id", $id)->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Event $event)
    {
        $this->authorize('delete');

        $event->deleted_at = date('Y-m-d H:i:s');
        $event->update();
    }
}
