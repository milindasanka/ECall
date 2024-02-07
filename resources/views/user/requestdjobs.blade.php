@extends('user.user')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('APPLICATION LIST') }}</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Application ID</th>
            <th scope="col">Job Title</th>
            <th scope="col">STATUS</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>
                    @php
                        $data = App\Models\jobs::where('id', $item->job_id)
                        ->first();
                        echo $data['job_title']
                    @endphp
                </td>
                <td>
                    @if($item->status == 1)
                        <button class="btn btn-primary" >ACCEPTED</button>
                    @elseif($item->status == 2)
                        <button class="btn btn-success" >JOIN INTERVIEW</button>
                    @else
                        <button class="btn btn-warning" >PENDING</button>
                    @endif
                </td>
                <td> <form action="/deleteapplicationx" method="POST">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $item->id }}">
                        @if($item->status == 2)
                            <button type="submit" class="btn btn-danger" disabled>Cancel</button>
                        @else
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        @endif
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>



@endsection