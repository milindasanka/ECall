@extends('user.user')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Interview Progress') }}</h1>
    <p>(IF Candidate get more than 50% marks Automatically Pass the Interview )</p>
    <div class="row">
        <div class="col-6">
            <div class="container mt-5">
                <form action="/getpoints" method="POST">
                    @csrf
                    <input type="hidden" name="coutouts" value="25">
                    <input type="hidden" name="id" value="{{$application}}">
                    <!-- Question 1 -->
                    <div class="mb-3">
                        <label class="form-label">1. {{$questions['q1']}}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1a" value="10">
                            <label class="form-check-label" for="q1a">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1b" value="5">
                            <label class="form-check-label" for="q1b">
                                Average
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1c" value="0">
                            <label class="form-check-label" for="q1c">
                                Bad
                            </label>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="mb-3">
                        <label class="form-label">2. {{$questions['q2']}}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q2" id="q1a" value="10">
                            <label class="form-check-label" for="q1a">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q2" id="q1b" value="5">
                            <label class="form-check-label" for="q1b">
                                Average
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q2" id="q1c" value="0">
                            <label class="form-check-label" for="q1c">
                                Bad
                            </label>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="mb-3">
                        <label class="form-label">3. {{$questions['q3']}}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q3" id="q1a" value="10">
                            <label class="form-check-label" for="q1a">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q3" id="q1b" value="5">
                            <label class="form-check-label" for="q1b">
                                Average
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q3" id="q1c" value="0">
                            <label class="form-check-label" for="q1c">
                                Bad
                            </label>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="mb-3">
                        <label class="form-label">4. {{$questions['q4']}}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q4" id="q1a" value="10">
                            <label class="form-check-label" for="q1a">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q4" id="q1b" value="5">
                            <label class="form-check-label" for="q1b">
                                Average
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q4" id="q1c" value="0">
                            <label class="form-check-label" for="q1c">
                                Bad
                            </label>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="mb-3">
                        <label class="form-label">5. {{$questions['q5']}}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q5" id="q1a" value="10">
                            <label class="form-check-label" for="q1a">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q5" id="q1b" value="5">
                            <label class="form-check-label" for="q1b">
                                Average
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q5" id="q1c" value="0">
                            <label class="form-check-label" for="q1c">
                                Bad
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-6">
            <div class="container mt-5">
                <h3>Manual Select</h3>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <form action="/approvex" method="POST" class="me-2">
                                    @csrf
                                    <input type="hidden" name="job_id" value="{{$application}}">
                                    <button type="submit" class="btn btn-success">ACCEPT</button>
                                </form>
                                <br>&nbsp;&nbsp;
                                <form action="/rejectx" method="POST">
                                    @csrf
                                    <input type="hidden" name="job_id" value="{{$application}}">
                                    <button type="submit" class="btn btn-danger">REJECT</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
