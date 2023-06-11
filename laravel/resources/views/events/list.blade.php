<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class='container-lg flex'>
        <div>
            <button {{ $prevPage < 0 ? 'disabled' : '' }}
                class='btn-primary {{ $prevPage < 0 ? 'bg-gray-500' : 'bg-sky-500' }}'
                onclick="window.location='/events/page/{{ $prevPage }}'">
                Previous
            </button>
            <button {{ $nextPage == 0 ? 'disabled' : '' }}
                class='btn-primary {{ $nextPage == 0 ? 'bg-gray-500' : 'bg-sky-500' }}'
                onclick="window.location='/events/page/{{ $nextPage }}'">
                Next
            </button>
        </div>
        <div>
            <button onclick="window.location='/events/create'" class='btn-primary'>
                New Event
            </button>
        </div>
    </div>

    <table class="table-auto">
        <thead>
            <th class="p-2 border-2">Event Name</th>
            <th class="p-2 border-2">Event Slug</th>
            <th class="p-2 border-2">Start - End Date</th>
            <th class="p-2 border-2">Actions</th>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr class="event-row">
                    <td class="p-3 border-2"><a href='/events/{{ $event->id }}'>{{ $event->name }}</a></td>
                    <td class="p-3 border-2">{{ $event->slug }} </td>
                    <td class="p-3 border-2">{{ $event->start_at . ' - ' . $event->end_at }}</td>
                    <td class="p-3 border-2 flex">
                        <form action="/events/{{ $event->id }}/edit">
                            <button class='btn-primary'>Edit</button>
                        </form>
                        <form method="post" action="/events/{{ $event->id }}">
                            @csrf
                            @method('delete')
                            <button class='btn-primary'>Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
