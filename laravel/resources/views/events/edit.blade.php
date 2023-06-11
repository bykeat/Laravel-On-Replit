<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <form method="post" action="/api/v1/events/{{ $event->id }}">
        <div class='w-80'>
            @csrf
            @method('patch')
            <div class='flex-row columns-2'>
                <div class='m-1'>
                    <label for="name">Event Name:</label>
                </div>
                <div class='m-1'>
                    <input type="text" value="{{ $event->name }}" name="name" />
                </div>
            </div>
            <div class='flex-row columns-2'>
                <div class='m-1'>
                    <label for="slug">Slug:</label>
                </div>
                <div class='m-1'>
                    <input type="text" value="{{ $event->slug }}" name="slug" />
                </div>
            </div>
            <div class='flex-row columns-2'>
                <div class='m-1'>
                    <label for="date">Start At:</label>
                </div>

                <div class='m-1'>
                    <input type="date" value="{{ date('Y-m-d', strtotime($event->start_at)) }}" name="start_at" />
                </div>
            </div>
            <div class='flex-row columns-2'>
                <div class='m-1'>
                    <label for="end_at">End At:</label>
                </div>
                <div class='m-1'>
                    <input type="date" value="{{ date('Y-m-d', strtotime($event->end_at)) }}" name="end_at" />
                </div>
            </div>
            <div class='flex-col columns-2'>
                <button class='btn-primary' type='button' onclick="window.location='/events'">Return</button>
                <button class='btn-primary'>Update</button>
            </div>
        </div>
    </form>
</body>

</html>
