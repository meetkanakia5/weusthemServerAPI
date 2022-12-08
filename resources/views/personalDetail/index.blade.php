<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            body {
                text-align: center;
            }
            form {
                display: inline-block;
            }
        </style>
    </head>
    
    <body>
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">FirstName</th>
                <th scope="col">email</th>
                <th scope="col">Option</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personalDetails as $details)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$details->fname}}</td>
                        <td>{{$details->email}}</td>
                        <td>
                            @if(!empty($details->getOptions))
                                @foreach ($details->getOptions as $option)
                                    {{$option->option}} {{($loop->last) ? '' : ','}}
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('personal-detail.update', $details->id) }}">Edit</a> | 
                            <a href="{{ route('personal-detail-delete', $details->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>