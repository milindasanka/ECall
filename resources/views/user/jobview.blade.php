@if(isset($message))
{!! $message !!}
@endif

    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E Jobs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @import url(https://fonts.googleapis.com/css?family=Hind);
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

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
            padding: 5px 0 5px;
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

        .tags-input-wrapper{
            padding: 10px;
            margin-top: 25px;
            border-radius: 4px;
            max-width: 400px;
            border: 1px solid #ccc
        }
        .tags-input-wrapper input{
            border: none;
            background: transparent;
            outline: none;
            width: 140px;
            margin-left: 8px;
        }
        .tags-input-wrapper .tag{
            display: inline-block;
            background-color: #4c4ffc;
            color: white;
            border-radius: 40px;
            padding: 5px 5px 5px 5px;
            margin-right: 5px;
            margin-bottom:5px;
            box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
        }
        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
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
@foreach($data as $item)
<header class="masthead">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="site-heading">
                    <h1 class="heading">
                        {{ $item->job_title }}
                    </h1>
                    <span class="subheading">
							{{ $item->place }} / {{ $item->job_category }}
                    </span>
                    <span class="subheading" style="font-weight: bold">
							{{ $item->company_name }}
                    </span>
                    @if($hide == 5)
                        <a href="{{ route('joblist') }}" class="btn btn-apply float-sm-right float-xs-left">
                            Close
                        </a>
                    @else
                    <a href="applythisjob/{{ $item->id }}" class="btn btn-apply float-sm-right float-xs-left">
                        Apply
                    </a>
                    @endif

                    <input type="text" name="skills" class="form-control" value="" id="tag-input1" placeholder="" disabled>
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
                        <li class="job-description" id="job-description">
                        </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const jobDescription = `<?php echo $item->job_description ?>`

        // Split the job description into sentences
        const sentences = jobDescription.split('.');

        // Create a list element
        const ul = document.createElement('ul');

        // Iterate over each sentence and create list items
        sentences.forEach(sentence => {
            const trimmedSentence = sentence.trim();
            if (trimmedSentence.length > 0) {
                const li = document.createElement('li');
                li.textContent = trimmedSentence;
                ul.appendChild(li);
            }
        });

        // Append the list to the job-description div
        document.getElementById('job-description').appendChild(ul);
    });


</script>
<script>
    (function(){

        "use strict"


        // Plugin Constructor
        var TagsInput = function(opts){
            this.options = Object.assign(TagsInput.defaults , opts);
            this.init();
        }

        // Initialize the plugin
        TagsInput.prototype.init = function(opts){
            this.options = opts ? Object.assign(this.options, opts) : this.options;

            if(this.initialized)
                this.destroy();

            if(!(this.orignal_input = document.getElementById(this.options.selector)) ){
                console.error("tags-input couldn't find an element with the specified ID");
                return this;
            }

            this.arr = [];
            this.wrapper = document.createElement('div');
            this.input = document.createElement('input');
            init(this);
            initEvents(this);

            this.initialized =  true;
            return this;
        }

        // Add Tags
        TagsInput.prototype.addTag = function(string){

            if(this.anyErrors(string))
                return ;

            this.arr.push(string);
            var tagInput = this;

            var tag = document.createElement('span');
            tag.className = this.options.tagClass;
            tag.innerText = string;

            var closeIcon = document.createElement('a');
            closeIcon.innerHTML = '&times;';

            // delete the tag when icon is clicked
            closeIcon.addEventListener('click' , function(e){
                e.preventDefault();
                var tag = this.parentNode;

                for(var i =0 ;i < tagInput.wrapper.childNodes.length ; i++){
                    if(tagInput.wrapper.childNodes[i] == tag)
                        tagInput.deleteTag(tag , i);
                }
            })


            this.wrapper.insertBefore(tag , this.input);
            this.orignal_input.value = this.arr.join(',');

            return this;
        }

        // Delete Tags


        // Make sure input string have no error with the plugin
        TagsInput.prototype.anyErrors = function(string){
            if( this.options.max != null && this.arr.length >= this.options.max ){
                console.log('max tags limit reached');
                return true;
            }

            if(!this.options.duplicate && this.arr.indexOf(string) != -1 ){
                console.log('duplicate found " '+string+' " ')
                return true;
            }

            return false;
        }

        // Add tags programmatically
        TagsInput.prototype.addData = function(array){
            var plugin = this;

            array.forEach(function(string){
                plugin.addTag(string);
            })
            return this;
        }

        // Get the Input String
        TagsInput.prototype.getInputString = function(){
            return this.arr.join(',');
        }


        // destroy the plugin
        TagsInput.prototype.destroy = function(){
            this.orignal_input.removeAttribute('hidden');

            delete this.orignal_input;
            var self = this;

            Object.keys(this).forEach(function(key){
                if(self[key] instanceof HTMLElement)
                    self[key].remove();

                if(key != 'options')
                    delete self[key];
            });

            this.initialized = false;
        }

        // Private function to initialize the tag input plugin
        function init(tags){
            tags.wrapper.append(tags.input);
            tags.wrapper.classList.add(tags.options.wrapperClass);
            tags.orignal_input.setAttribute('hidden' , 'true');
            tags.orignal_input.parentNode.insertBefore(tags.wrapper , tags.orignal_input);
        }

        // initialize the Events
        function initEvents(tags){
            tags.wrapper.addEventListener('click' ,function(){
                tags.input.focus();
            });


            tags.input.addEventListener('keydown' , function(e){
                var str = tags.input.value.trim();

                if( !!(~[9 , 13 , 188].indexOf( e.keyCode ))  )
                {
                    e.preventDefault();
                    tags.input.value = "";
                    if(str != "")
                        tags.addTag(str);
                }

            });
        }


        // Set All the Default Values
        TagsInput.defaults = {
            selector : '',
            wrapperClass : 'tags-input-wrapper',
            tagClass : 'tag',
            max : null,
            duplicate: false
        }

        window.TagsInput = TagsInput;

    })();

    var tagInput1 = new TagsInput({
        selector: 'tag-input1',
        duplicate : false,
        max : 10
    });

    tagInput1.addData(<?php echo $item->skills; ?>)
</script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</body>
</html>
