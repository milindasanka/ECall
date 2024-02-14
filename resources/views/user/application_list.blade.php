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
            <th scope="col">Time</th>
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
                @elseif($item->status == 1)
                    <td>
                        <form action="/createmeeting" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $item->id }}">
                            <input type="datetime-local" name="time" class="form-control datetimepicker-input" style="width: 120px;">
                            <button type="submit" class="btn btn-warning btn-sm" >CREATE MEETING</button>
                        </form>
                    </td>
                @elseif($item->status == 2)
                    <td>
                        <form action="/modulatorjoin" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-success" >START MEETING</button>
                        </form>
                    </td>
                @elseif($item->status == 4)
                    <td>
                        <button type="submit" class="btn btn-secondary" >INTERVIEW OVER</button>
                    </td>
                @endif
                @if($item->status == 2)
                    <td>{{$item->date}}</td>
                @else
                    <td> <form action="/deleteapplication" method="POST">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection
