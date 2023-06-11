<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pull External API Data</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div>

        <table>
            <thead>
                @foreach ($headers as $header)
                    <th class='p-3'>{{ $header }}</th>
                @endforeach
            </thead>
            <tbody>
                @foreach ($body as $item)
                    <tr>
                        @foreach ($headers as $header)
                            <td class='p-3 border-2'>{{ $item->{$header} }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</body>

</html>
