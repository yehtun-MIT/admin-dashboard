@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="d-flex">
                <div class="col-md-4">
                    <a class="btn btn-success" href="{{ route('admin.posts.create') }}">Add Posts</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">body</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title ?? ' ' }}</td>
                            <td>{{ $post->body ?? ' ' }}</td>
                            <td>
                                @if ($post->photo)
                                    <a href="{{ $post->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $post->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                                <a class="btn btn-primary" href="{{ route('admin.posts.show', [$post->id]) }}">Show</a>
                                <button class="btn btn-success">edit</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
