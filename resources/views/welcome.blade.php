<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FLEXHAIER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @import url(https://fonts.googleapis.com/css?family=Hind);
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);
        .searchbox {
            background-color:#fff;
            padding: 10px 7px 10px 40px;
            border-radius: 50px;
        }
        .searchbox [class*="col-"] {
            padding: 0px;
        }
        .searchbox .col-md-5, .searchbox .col-md-3 {
            padding-top: 12px;
            padding-bottom: 12px;
        }
        .searchbox .form-control {
            border-color: transparent;
            border-right:solid 1px rgba(0,0,0,0.10);
        }
        .searchbox select.form-control {
            border-right:solid 1px transparent;
        }
        .searchbox .form-control:focus {
            outline: 0;
        }
        .searchbox .btn { border-radius:40px; padding:20px 40px; }

        /* ------ Select Chosen Styles ---- */
        .searchbox .chosen-single,
        .searchbox .chosen-container-multi .chosen-choices li.search-field input[type="text"],
        .searchbox .chosen-container-single .chosen-single {
            padding: 0 28px;
            width: 100% !important;
            margin: 0;
            border: solid 1px #c4cad0 !important;
            height: 40px;
            line-height: 22px;
            font-size: 14px;
            font-weight: normal;
            box-sizing:border-box;
            -moz-box-sizing:border-box;
            -webkit-box-sizing:border-box;
            border-radius: 23px;
            background: none;
        }

        .searchbox .chosen-single,
        .searchbox .chosen-container-multi .chosen-choices li.search-field input[type="text"],
        .searchbox .chosen-container-single .chosen-single {
            font-size: 15px;
        }

        .searchbox .chosen-single,
        .searchbox .chosen-container-multi .chosen-choices li.search-field input[type="text"],
        .searchbox .chosen-container-single .chosen-single {
            border: none !important;
            background: #fff !important;
        }

        .searchbox .chosen-container-multi .chosen-choices {
            background: none;
        }

        .searchbox .chosen-container-multi .chosen-choices li.search-field {
            float: none;
        }

        .searchbox .chosen-single,
        .searchbox .chosen-container-single .chosen-single,
        .searchbox .chosen-container-multi .chosen-choices li.search-field input[type="text"]{
            padding-right: 50px;
        }

        .searchbox .chosen-single span {
            display: block;
            padding: 0;
            margin: 0;
            line-height: 40px;
        }

        .searchbox .chosen-container-single .chosen-single {
            background: none !important;
            box-shadow: none !important;
        }

        .searchbox .chosen-container-active .chosen-single,
        .searchbox .chosen-container-active .chosen-choices {
            box-shadow: none;
        }

        .searchbox .chosen-single,
        .searchbox .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
            color: #334e6f !important;
        }

        .searchbox .chosen-container-multi .chosen-choices li.search-field input[type="text"],
        .main_wrapper .select-tags:after {
            color: #fff !important;
        }

        .searchbox .chosen-container {
            text-align: left;
        }

        .searchbox .chosen-drop {
            margin: 5px 0 0 0;
            background: #fff;
            border-radius: 5px;
            border: none;
            overflow: hidden;
            box-shadow: 20px 20px 50px rgba(58, 87, 135, 0.1);
        }

        .searchbox .chosen-drop ul.chosen-results {
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .searchbox .chosen-drop ul.chosen-results li:before {
            display: none;
        }

        .searchbox .chosen-drop ul.chosen-results li {
            padding: 6px 30px 7px 30px;
            line-height: 22px;
            font-size: 14px;
            color: #334e6f;
            background: none !important;
        }

        .searchbox .chosen-drop ul.chosen-results li:first-child {
            padding-top: 25px;
        }

        .searchbox .chosen-drop ul.chosen-results li:last-child {
            padding-bottom: 23px;
        }

        .searchbox .chosen-choices {
            padding: 0;
            margin: 0;
            border: none;
        }

        .searchbox .chosen-choices li {
            width: 100%;
            display: block;
        }

        .searchbox .chosen-choices li.search-choice {
            display: none;
        }

        .searchbox .chosen-choices li:before,
        .searchbox .chosen-choices li:after {
            display: none;
        }

        .searchbox .chosen-single > div {
            display: none;
        }

        .searchbox .chosen-single {
            position: relative;
        }

        .searchbox .chosen-single:after {
            content: "\f107";
            right: 28px;
            top: 50%;
            width: auto;
            height: auto;
            background: none;
            font-family:'FontAwesome';
            transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            color: #999999;
            display: block;
            pointer-events: none;
            position: absolute;
            font-size: 28px;
            line-height: 22px;
        }
        /* ------ End Select Chosen Styles ---- */

        footer {
            background-color:#fff;
            padding: 3% 0px;
        }
        footer p { color:#999; }
        @media (max-width:767px) {
            .searchbox .btn { width:100%; }
            .searchbox {
                padding: 20px 40px;
            }
            .searchbox .form-control {
                border-color: transparent;
                border-bottom:solid 1px rgba(0,0,0,0.10);
            }
            .searchbox select.form-control {
                border-bottom:solid 1px transparent;
            }
        }
        body {
            font-family: 'Open Sans', sans-serif;
            color: #31383d;
            font-size: 1.1rem;
        }

        section {
            padding: 30px 0;
            background: #fff;
        }

        p {
            line-height: 1.5;
            margin: 30px 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Hind', sans-serif;
            font-weight: 800;
        }

        a {
            color: #31383d;
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }

        a:hover,
        a:focus {
            color: #73a5fc;
        }

        #navbar-main {
            position: absolute;
            font-family: 'Hind', sans-serif;
            background-color: #fff;
            border-bottom: 1px solid #d7e2e9;
        }

        #navbar-main .navbar-brand {
            color: #96a4b1;
        }

        #navbar-main .navbar-toggler {
            padding: 0.5rem;
            border: none;
        }

        #navbar-main .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(68, 189, 255)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

        #navbar-main .navbar-nav > li.nav-item > a {
            text-transform: uppercase;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-align: center;
        }

        #navbar-main .navbar-brand .fa-cube {
            font-size: 2rem;
        }

        header.masthead {
            padding-top: 4rem;
            padding-bottom: 4rem;
            margin-bottom: 3rem;
            background: #a3bded;
            background: -webkit-linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
            background: -moz-linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
            background: linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
        }

        header.masthead .site-heading {
            padding: 100px 0 50px;
            color: #fff;
        }

        header.masthead .site-heading h1 {
            font-size: 2.3rem;
        }

        header.masthead .site-heading .subheading {
            display: block;
            font-weight: 300;
            margin: 0.625rem 0 0;
            color: #fff;
        }

        ul.job-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul.job-list > li.job-preview {
            background: #fff;
            border: 1px solid #d7e2e9;
            -webkit-border-radius: 0.4rem;
            -moz-border-radius: 0.4rem;
            border-radius: 0.4rem;
            padding: 1.5rem 2rem;
            margin-bottom: 1rem;
            float: left;
            width: 100%;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        ul.job-list > li.job-preview:hover {
            cursor: pointer;
            -webkit-box-shadow: 0 3px 8px rgba(0,0,0,0.05);
            -moz-box-shadow: 0 3px 8px rgba(0,0,0,0.05);
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        .job-title {
            margin-top: 0.6rem;
        }

        .company {
            color: #96a4b1;
        }

        .job-preview .btn {
            margin-top: 1.1rem;
        }

        .btn-apply {
            text-transform: uppercase;
            font-size: 0.875rem;
            font-weight: 800;
            letter-spacing: 1px;
            background-color: transparent;
            color:  #393a5f;
            border: 2px solid #393a5f;
            padding: 0.6rem 2rem;
            -webkit-border-radius: 2rem;
            -moz-border-radius: 2rem;
            border-radius: 2rem;
        }

        .btn-apply:hover {
            background-color: #393a5f;
            color:  #fff;
            border: 2px solid #393a5f;
        }

        @media (max-width: 575px) {
            .job-preview .content {
                width: 100%;
            }
        }

        @media only screen and (min-width: 992px) {
            #navbar-main {
                background: transparent;
                border-bottom: 1px solid transparent;
            }

            #navbar-main .navbar-brand {
                color: #fff;
                opacity: 0.8;
                padding: 0.95rem 1.2rem;
            }

            #navbar-main .navbar-brand:hover,
            #navbar-main .navbar-brand:focus {
                opacity: 1;
            }

            #navbar-main .navbar-nav > li.nav-item > a {
                color: #fff;
                opacity: 0.8;
                padding: 0.95rem 1.2rem;
            }

            #navbar-main .navbar-nav > li.nav-item > a:hover,
            #navbar-main .navbar-nav > li.nav-item > a:focus {
                opacity: 1;
            }
        }

        footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 0.5rem;
            background-color: #efefef;
            text-align: center;
        }

        /* footer text */
        footer div p{
            font-family: rubik one;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        footer div p i.red{
            color: red;
            size: 24px;
        }

        /* footer text effects */
        footer div p span{
            transition: background-color,color 1500ms ease;
            background-color: black;
            color: white;
        }

        footer div p span:hover{
            background-color:white ;
            color: black;
        }

        /* Footer Image Links */
        footer a.github {
            -webkit-transition:color 500ms ease;
            -moz-transition:color 500ms ease;
            -o-transition:color 500ms ease;
            transition: color 500ms ease;
            font-size: 3em;
            color: rgb(13,38,54);
            padding: 10px;
            display:inline-block;
        }

        footer a.codepen {
            -webkit-transition:color 500ms ease;
            -moz-transition:color 500ms ease;
            -o-transition:color 500ms ease;
            transition: color 500ms ease;
            font-size: 3em;
            color: black;
            padding: 10px;
            display:inline-block;
        }

        /* image links hover effects */
        footer a.github:hover {
            color: darkgray;
        }

        footer a.codepen:hover {
            color: darkgray;
        }

        /* Resposive Footer */
        footer.mobile {
            display:none;
        }

        @media screen and (max-width: 400px) {
            footer.pc {
                display:none;
            }
            footer.mobile {
                display:block;
            }
            footer.mobile div p {
                font-size: 15px;
            }

        }
    </style>
</head>
<body>

<nav class="navbar navbar-toggleable-md navbar-light fixed-top" id="navbar-main">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/" title="Home">
        <img src="/img/logo.png" style="height: 75px;">
    </a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            @auth
                @if(Auth::id() == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home')}}" title="Home">
                            Home
                        </a>
                    </li>
                 @else
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home2')}}" title="Home">
                            Home
                        </a>
                    </li>
                @endif
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ url('login') }}" title="Login">
                    Login
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/UserRegister') }}" title="Register">
                    Register
                </a>
            </li>
            @endauth
        </ul>
    </div>
</nav>

<header class="masthead">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="site-heading">
                    <h2 class="heading">
                        Find Positions
                    </h2>
                    <span class="subheading">

{{--							Search Bar Start --}}
                              <div class="searchbox">
                                  <form action="search_list" method="GET">
                                    <div class="row">
                                      <div class="col-md-5"><input type="text" name="search_key" class="form-control" placeholder="Job title, keywords, or company...."></div>
                                      <div class="col-md-5">
                                        <select class="form-control category" name="search_cat">
                                            <option value="">Location</option>
                                            <option value="On Site">On Site</option>
                                            <option value="Remote">Remote</option>
                                            <option value="Hybrid">Hybrid</option>
                                        </select>
                                      </div>
                                      <div class="col-md-2"><input type="submit" class="btn btn-primary" class="form-control" value="Search"></div>
                                    </div>
                                  </form>
                              </div>

{{--							Search Bar End --}}

						</span>
                </div>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <ul class="job-list">
                    @foreach($data as $item)
                    <li class="job-preview">
                        <div class="content float-left">
                            <h4 class="job-title">
                                {{ $item->job_title }}  <span class="company" style="font-size: 15px;"> ({{$item->place}})</span>
                            </h4>
                            <h5 class="company">
                                {{ $item->company_name }}
                            </h5>
                        </div>
                        <a href="{{ route('jobview', ['id' => $item->id, 'h' => 0]) }}" class="btn btn-apply float-sm-right float-xs-left">
                            Apply
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</body>
</html>
