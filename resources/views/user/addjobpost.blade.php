@extends('user.user')

@section('main-content')
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
    <form class="needs-validation" action="addNewjob" method="POST">
        @csrf
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Job Title</label>
                <input type="text" class="form-control" id="job_title" placeholder="job title" name="job_title" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Job Category</label>
                <select class="custom-select" name="job_category">
                    <option value="Software Engineer">Software Engineer</option>
                    <option value="Project Manager">Project Manager</option>
                    <option value="QA Engineer">QA Engineer</option>
                    <option value="UI UX Designer">UI UX Designer</option>
                    <option value="Tech Lead">Tech Lead</option>
                    <option value="Graphic Designer">Graphic Designer</option>
                    <option value="Business Analyst">Business Analyst</option>
                    <option value="System Administrator">System Administrator</option>
                    <option value="Data Engineer">Data Engineer</option>
                    <option value="Software Architect">Software Architect</option>
                </select>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Company Name</label>
                <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Work Environment</label>
                <select class="custom-select" name="place">
                    <option value="On Site">On Site</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Remote">Remote</option>
                </select>
            </div>

            <div class="col-sm-6 form-group">
                <label for="pass2">Skills</label>
                <input type="text" name="skills" class="form-control" id="tag-input1" placeholder="" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">About the job</label>
                <textarea class="form-control" id="job_description" rows="5" placeholder="Job Description" name="job_description" required></textarea>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Add Job</button>
    </form>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
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

    </script>
@endsection
