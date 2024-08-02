<!DOCTYPE html>
<html>
<head>
    <title>FLEXHAIER Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="text-center mt-5">FLEXHAIER {{$report_type}} Report</h2>
    <p class="text-center"><strong>From:</strong> {{ $from->toFormattedDateString() }} <strong>To:</strong> {{ $to->toFormattedDateString() }}</p>

    <div class="card mt-4">
        <div class="card-header">
            Applications
        </div>
        <div class="card-body">
            <ul>

                    <li>{{$applications}}</li>

            </ul>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Pending Interviews
        </div>
        <div class="card-body">
            <ul>

                    <li>{{$pending_interviews}}</li>

            </ul>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Hired
        </div>
        <div class="card-body">
            <ul>
                    <li>{{$hairs}}</li>
            </ul>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Open Jobs
        </div>
        <div class="card-body">
            <ul>
                    <li>{{$openjobs}}</li>
            </ul>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            New Users
        </div>
        <div class="card-body">
            <ul>
                    <li>{{$newusers}}</li>
            </ul>
        </div>
    </div>
</div>


<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span style="font-size: 10px; align-content: end" >FLEXHAIER Auto Generated {{ now()->year }} - {{ now()->month }} - {{ now()->day }}</span>
        </div>
    </div>
</footer>

</body>
</html>
