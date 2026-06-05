<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <table class="table table-bordered">
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        @foreach ($profiles as $item)
            <tr>
                <td>{{ $item->email }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->profiles->phone }}</td>
                <td>{{ $item->profiles->address }}</td>
            </tr>
        @endforeach
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
