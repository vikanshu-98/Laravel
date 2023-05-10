<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->name }}</td>
                <td>
                    <select name="cars" id="{{ $invoice->id }}">
                    <option value="{{ $invoice->email }}">{{ $invoice->email }}</option> 
                </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
</body>
</html>