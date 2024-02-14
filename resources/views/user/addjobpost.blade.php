@extends('user.user')

@section('main-content')
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
                <label for="validationCustom01">Job Title</label>
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
                <label for="validationCustom01">About the job</label>
                <textarea class="form-control" id="job_description" rows="5" placeholder="Job Description" name="job_description" required></textarea>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Work Environment</label>
                <select class="custom-select" name="place">
                    <option value="On Site">On Site</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Remote">Remote</option>
                </select>
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
    </script>
@endsection
