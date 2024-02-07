@extends('user.user')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('APPLICATION LIST') }}</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Application ID</th>
            <th scope="col">Job ID</th>
            <th scope="col">View Action</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->job_id }}</td>
                <td>
                    <button class="btn btn-info" ><a href="{{ route('application.viewappliction', ['job_id' => $item->id]) }}" target="_blank" style="color: white">View Application</a></button>
                </td>
                @if($item->status == null)
                    <td>
                        <form action="/acceptjob" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-success" >Accept</button>
                        </form>
                    </td>
                @else
                    <td>
                        <form action="/#" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-warning" >CREATE MEETING</button>
                        </form>
                    </td>
                @endif

                <td> <form action="/deleteapplication" method="POST">
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
