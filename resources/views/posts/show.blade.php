<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                      ID 
                    </th>
                    <td>
                        {{ $post->id ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                       Title 
                    </th>
                    <td>
                        {{ $post->title ?? ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>
                       Body
                    </th>
                    <td>
                        {{ $post->body ?? ' ' }}
                    </td>
                </tr>
                <tr>
                    <th>
                       Photo
                    </th>
                    <td>
                        @if ( $post->photo)
                        <a href="{{ $post->photo->getUrl() }}" target="_blank" >
                             <img src="{{ $post->photo->getUrl('thumb') }}" >
                        </a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="">
            <a href="{{route('admin.posts.index')}}" class="btn btn-success">Back</a>
        </div>
    </div>
</body>
</html>