<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Services\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/events')->group(function () {

    //List Events
    Route::get('/page/{page}', function ($currentPage) {
        $paginator = App::make(Paginator::class);

        $activeEvents = Event::where('deleted_at', null);
        $totalRows = $activeEvents->count();

        list($prevPage, $nextPage, $skip, $pageLimit) = $paginator->getPagingNumber($currentPage, $totalRows);
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
    });

    //Create Event
    Route::get('/create', function () {
        return view('events.create');
    });

    //View Event
    Route::get('/{id}', function ($id) {
        return view('events.view', [
            'event' => Event::find($id)
        ]);
    });
});

Route::resource('events', EventController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']); //->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pull-api-data', function () {
    $client = new GuzzleHttp\Client(['verify' => false]);

    $response = $client->request('get', 'https://api.publicapis.org/entries');

    //Generate column header
    $contents =  $response->getBody()->getContents();
    $contentType = $response->getHeader('Content-Type')[0];
    if (!empty($contents) && strpos($contentType, 'json') !== false) {
        $contents = json_decode($contents);
        $contentEntries = $contents->entries;
        $headers = [];
        foreach (reset($contentEntries) as $header => $value) {
            $headers[] = $header;
        }
    } else {
        $contents = [];
    }

    return view('misc.api_data', [
        'content-type' => $contentType,
        'headers' => $headers ?: [],
        'body' => $contentEntries,
    ]);
});

require __DIR__ . '/auth.php';
