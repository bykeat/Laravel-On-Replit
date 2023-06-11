<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    private $fieldValidations = [
        'name' => 'string|required|max:255',
        'slug' => 'string|required|regex:^[a-zA-Z\-0-9]+$',
        'start_at' => 'string|required',
        'end_at' => 'string|required',
    ];

    /**
     * List all events.
     * @return string
     */
    public function index($currentPage = 0)
    {
        $paginator = App::make(Paginator::class);

        $activeEvents = Event::where('deleted_at', null);

        $totalRows = $activeEvents->count();

        list(
            $prevPage,
            $nextPage,
            $skip,
            $pageLimit
        ) = $paginator->getPagingNumber(
            $currentPage,
            $totalRows
        );

        if (Cache::getDefaultDriver() == 'redis' && Cache::tags("events")->has("event-list-$currentPage")) {
            $events = Cache::tags("events")->get("event-list-$currentPage");
        } else {
            $events = $activeEvents->limit($pageLimit)
                ->skip($skip)
                ->get();
            if (Cache::getDefaultDriver() == 'redis') {
                Cache::tags('events')->put("event-list-$currentPage", $events, '30');
            }
        }

        return view('events.list', [
            'events' => $events,
            'count' => $totalRows,
            'prevPage' => $prevPage ?: 0,
            'nextPage' => $nextPage ?: 0,
        ]);
    }


    /**
     * Edit an event
     */
    public function edit(Request $request, Event $event)
    {
        return view(
            'events.edit',
            ['event' => $event]
        );
    }

    /**
     * Update an event
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate($this->fieldValidations);

        $this->authorize('update', $event);
        $event->update($validated);

        return redirect(route('events.view'));
    }

    /**
     * Show an event
     */
    public function view($id)
    {
        return Event::where("id", $id)->get();
    }

    /**
     * Destroy an event
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->deleted_at = date('Y-m-d H:i:s');
        $event->update();

        return redirect(route('events.index'));
    }
}
