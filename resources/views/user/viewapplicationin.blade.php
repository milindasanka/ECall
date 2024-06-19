<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Job Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Application ID : {{$id}}</h2>
    <p>We have received the following information</p>
    <ul>
        <li><strong>Name:</strong> {{$name}} </li>
        <li><strong>Email:</strong> {{$email}} </li>
        <li><strong>Position:</strong>{{$position}} </li>
        <li><strong>Contact No:</strong>{{$contact_no}} </li>
        <li><strong>Education Level:</strong> {{$eduction_level}} </li>
        <li><strong>Experience Level:</strong> {{$experience_level}} </li>
        <li><strong>Skills:</strong> @foreach(json_decode($skills) as $item)
                <span>{{$item}}</span>
            @endforeach </li>
        <li><strong>Description:</strong> {{$description}} </li>
        <li><strong>CV:</strong> <button class="btn btn-success btn-sm" ><a href="{{$cv}}" target="_blank" style="color: white">Download CV</a></button> </li>
    </ul>

</div>
</body>
</html>
