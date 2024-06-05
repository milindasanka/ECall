@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        <style>
        label {
            font-weight: 600;
            color: #666;
        }
        body {
            background: #f1f1f1;
        }
        .box8{
            box-shadow: 0px 0px 5px 1px #999;
        }
        .mx-t3{
            margin-top: -3rem;
        }

        .tags-input-wrapper{
            padding: 10px;
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
            padding: 0px 3px 0px 7px;
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

    <div class="container mt-3">
        <form action="/cvprofile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row jumbotron box8">
                <div class="col-sm-12 mx-t3 mb-4">
                    <h2 class="text-center text-info">My CV</h2>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="name-f">First Name</label>
                    <input type="text" class="form-control" name="fname" id="name-f" value="{{$f_name}}" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="name-l">Last name</label>
                    <input type="text" class="form-control" name="lname" id="name-l" value="{{$l_name}}" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$email}}" disabled>
                    <input type="hidden" class="form-control" name="email" id="email" value="{{$email}}" >
                </div>
                <div class="col-sm-12 form-group">
                    <label for="address-1">About me</label>
                    <input type="text" class="form-control" name="about_me" id="about_me" value="{{$description}}" required>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="address-2">Current status</label>
                    <select id="position" name="position" class="form-control browser-default custom-select">
                        <option value="Current status" <?php if ($position == '') echo 'selected'; ?>>Current status</option>
                        <option value="Software Engineer" <?php if ($position == 'Software Engineer') echo 'selected'; ?>>Software Engineer</option>
                        <option value="Project Manager" <?php if ($position == 'Project Manager') echo 'selected'; ?>>Project Manager</option>
                        <option value="QA Engineer" <?php if ($position == 'QA Engineer') echo 'selected'; ?>>QA Engineer</option>
                        <option value="UI UX Designer" <?php if ($position == 'UI UX Designer') echo 'selected'; ?>>UI UX Designer</option>
                        <option value="Tech Lead" <?php if ($position == 'Tech Lead') echo 'selected'; ?>>Tech Lead</option>
                        <option value="Graphic Designer" <?php if ($position == 'Graphic Designer') echo 'selected'; ?>>Graphic Designer</option>
                        <option value="Business Analyst" <?php if ($position == 'Business Analyst') echo 'selected'; ?>>Business Analyst</option>
                        <option value="System Administrator" <?php if ($position == 'System Administrator') echo 'selected'; ?>>System Administrator</option>
                        <option value="Data Engineer" <?php if ($position == 'Data Engineer') echo 'selected'; ?>>Data Engineer</option>
                        <option value="Software Architect" <?php if ($position == 'Software Architect') echo 'selected'; ?>>Software Architect</option>
                    </select>

                </div>
                <div class="col-sm-4 form-group">
                    <label for="State">Education Level</label>
                    <select id="education_level" name="education_level" class="form-control browser-default custom-select">
                        <option value="Education Level" <?php if ($education_level == '') echo 'selected'; ?>>Education Level</option>
                        <option value="Advanced Level" <?php if ($education_level == 'Advanced Level') echo 'selected'; ?>>Advanced Level</option>
                        <option value="Diploma" <?php if ($education_level == 'Diploma') echo 'selected'; ?>>Diploma</option>
                        <option value="Higher National Diploma" <?php if ($education_level == 'Higher National Diploma') echo 'selected'; ?>>Higher National Diploma</option>
                        <option value="Undergraduate" <?php if ($education_level == 'Undergraduate') echo 'selected'; ?>>Undergraduate</option>
                        <option value="Bachelor of Degree" <?php if ($education_level == 'Bachelor of Degree') echo 'selected'; ?>>Bachelor of Degree</option>
                        <option value="Master's Degree" <?php if ($education_level == "Master's Degree") echo 'selected'; ?>>Master's Degree</option>
                        <option value="Doctoral Degree" <?php if ($education_level == 'Doctoral Degree') echo 'selected'; ?>>Doctoral Degree</option>
                    </select>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="zip">Experience Level</label>
                    <select id="experience_level" name="experience_level" class="form-control browser-default custom-select">
                        <option value="Experience Level" <?php if ($experience_level == '') echo 'selected'; ?>>Experience Level</option>
                        <option value="6 Month" <?php if ($experience_level == '6 Month') echo 'selected'; ?>>6 Month</option>
                        <option value="1 Year" <?php if ($experience_level == '1 Year') echo 'selected'; ?>>1 Year</option>
                        <option value="2 Years" <?php if ($experience_level == '2 Years') echo 'selected'; ?>>2 Years</option>
                        <option value="3 Years" <?php if ($experience_level == '3 Years') echo 'selected'; ?>>3 Years</option>
                        <option value="4 Years" <?php if ($experience_level == '4 Years') echo 'selected'; ?>>4 Years</option>
                        <option value="5 Years" <?php if ($experience_level == '5 Years') echo 'selected'; ?>>5 Years</option>
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Date">Date Of Birth</label>
                    <input type="Date" name="dob" class="form-control" value="{{$birthday}}" id="Date" placeholder="" required>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="tel">Phone</label>
                    <input type="tel" name="phone" class="form-control" id="tel"  value="{{$contact_no}}" required>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="pass2">Skills</label>
                    <input type="text" name="skills" class="form-control" value="{{$skills}}" id="tag-input1" placeholder="" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass2">CV</label>
                    <input type="file" name="file" class="form-control" placeholder="" >
                    @if($cv)
                        <a href="{{$cv}}">VIEW CV</a>
                    @endif
                </div>
                <div class="col-sm-12 form-group mb-0">
                    <button class="btn btn-primary float-right">Save Changes</button>
                </div>

            </div>
        </form>
    </div>

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


                tag.appendChild(closeIcon);
                this.wrapper.insertBefore(tag , this.input);
                this.orignal_input.value = this.arr.join(',');

                return this;
            }

            // Delete Tags
            TagsInput.prototype.deleteTag = function(tag , i){
                tag.remove();
                this.arr.splice( i , 1);
                this.orignal_input.value =  this.arr.join(',');
                return this;
            }

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

        tagInput1.addData(<?php echo $skills; ?>)
    </script>

@endsection
