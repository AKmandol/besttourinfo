<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
</head>
<body>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$name}}</td>
                <td>{{$email}}</td>
                <td>{{$phone}}</td>
                <td>{{$msg}}</td>
            </tr>
        </tbody>
        
    </table>
    
</body>
</html>