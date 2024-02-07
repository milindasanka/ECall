<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E Jobs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
</head>
<body>
    <div class="container mt-3">
    <form action="/adduser" method="POST">
        @csrf
        <div class="row jumbotron box8">
            <div class="col-sm-12 mx-t3 mb-4">
                <h2 class="text-center text-info">Register</h2>
            </div>
            <div class="col-sm-6 form-group">
                <label for="name-f">First Name</label>
                <input type="text" class="form-control" name="fname" id="name-f" placeholder="Enter your first name." required>
            </div>
            <div class="col-sm-6 form-group">
                <label for="name-l">Last name</label>
                <input type="text" class="form-control" name="lname" id="name-l" placeholder="Enter your last name." required>
            </div>
            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
            </div>
            <div class="col-sm-6 form-group">
                <label for="address-1">About me</label>
                <input type="text" class="form-control" name="about_me" id="about_me" placeholder="About me" required>
            </div>
            <div class="col-sm-4 form-group">
                <label for="address-2">Current status</label>
                <select id="position" name="position" class="form-control browser-default custom-select">
                    <option value="Current status" selected>Current status</option>
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
            </div>
            <div class="col-sm-4 form-group">
                <label for="State">Education Level</label>
                <select id="education_level" name="education_level" class="form-control browser-default custom-select">
                    <option value="Education Level" selected>Education Level</option>
                    <option value="Advanced Level" >Advanced Level</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Higher National Diploma">Higher National Diploma</option>
                    <option value="Undergraduate">Undergraduate</option>
                    <option value="Bachelor of Degree">Bachelor of Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="Doctoral Degree">Doctoral Degree</option>
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="zip">Experience Level</label>
                <select id="experience_level" name="experience_level" class="form-control browser-default custom-select">
                    <option value="Experience Level" selected>Experience Level</option>
                    <option value="6 Month">6 Month</option>
                    <option value="1 Year">1 Year</option>
                    <option value="2 Years">2 Years</option>
                    <option value="3 Years">3 Years</option>
                    <option value="4 Years">4 Years</option>
                    <option value="5 Years">5 Years</option>
                </select>
            </div>
            <div class="col-sm-6 form-group">
                <label for="Date">Date Of Birth</label>
                <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required>
            </div>
            <div class="col-sm-6 form-group">
                <label for="sex">Gender</label>
                <select id="sex" name="sex" class="form-control browser-default custom-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="unspesified">Unspecified</option>
                </select>
            </div>
            <div class="col-sm-2 form-group">
                <label for="cod">Country code</label>
                <select class="form-control browser-default custom-select">
                    <option data-countryCode="US" value="1" selected>USA (+1)</option>
                    <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                </select>
            </div>
            <div class="col-sm-4 form-group">
                <label for="tel">Phone</label>
                <input type="tel" name="phone" class="form-control" id="tel" placeholder="Enter Your Contact Number." required>
            </div>
            <div class="col-sm-6 form-group">
                <label for="pass">Password</label>
                <input type="Password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
            </div>
            <div class="col-sm-6 form-group">
                <label for="pass2">Confirm Password</label>
                <input type="Password" name="cnf-password" class="form-control" id="pass2" placeholder="Re-enter your password." required>
                <span id="message" style="color: red;"></span>
            </div>
            <div class="col-sm-6 form-group">
                <label for="pass2">Skills</label>
                <input type="text" name="skills" class="form-control" id="tag-input1" placeholder="" required>
            </div>
            <div class="col-sm-12">
                <input type="checkbox" class="form-check d-inline" id="chb" required><label for="chb" class="form-check-label">&nbsp;I accept all terms and conditions.
                </label>
            </div>

            <div class="col-sm-12 form-group mb-0">
                <button class="btn btn-primary float-right">Register</button>
            </div>

        </div>
    </form>
</div>
<script>
    // Get the password and confirm password input elements
    const passwordField = document.getElementById('pass');
    const confirmPasswordField = document.getElementById('pass2');
    const message = document.getElementById('message');

    // Function to check if passwords match
    function validatePassword() {
        if (passwordField.value !== confirmPasswordField.value) {
            message.textContent = 'Passwords do not match';
        } else {
            message.textContent = '';
        }
    }

    // Event listeners to trigger validation on input
    passwordField.addEventListener('input', validatePassword);
    confirmPasswordField.addEventListener('input', validatePassword);

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
    // tagInput1.addData(['PHP' , 'JavaScript' , 'CSS'])

</script>
</body>
</html>
