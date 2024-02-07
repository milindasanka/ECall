@extends('user.user')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('JOBS LIST') }}</h1>

    <a class="nav-link" href="{{ url('/addjobpost')}}">
        <button type="button" class="btn btn-primary">+ Create Job Post</button><br><br>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Job ID</th>
            <th scope="col">Job Title</th>
            <th scope="col">Job Category</th>
            <th scope="col">Job Description</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->job_title }}</td>
                <td>{{ $item->job_category }}</td>
                <td>{{ $item->job_description }}</td>
                <td>
                    <form action="/jobdelu" method="POST">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>



@endsection
