<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <form class='w-80' method="post" action="/api/v1/events">
        @csrf
        <div class='flex-row columns-2'>
            <div class='m-1'>
                <label for="name">Event Name:</label>
            </div>
            <div class='m-1'>
                <input type="text" name="name" />
            </div>
        </div>
        <div class='flex-row columns-2'>
            <div class='m-1'>
                <label for="slug">Slug:</label>
            </div>
            <div class='m-1'>
                <input type="text" name="slug" />
            </div>
        </div>
        <div class='flex-row columns-2'>
            <div class='m-1'>
                <label for="date">Start At:</label>
            </div>

            <div class='m-1'>
                <input type="date" name="start_at" />
            </div>
        </div>
        <div class='flex-row columns-2'>
            <div class='m-1'>
                <label for="end_at">End At:</label>
            </div>
            <div class='m-1'>
                <input type="date" name="end_at" />
            </div>
        </div>
        <div>
            <button class='btn-primary' type='button' onclick="window.location='/events'">Return</button>
            <button class='btn-primary'>Create</button>
        </div>
    </form>
</body>

</html>
