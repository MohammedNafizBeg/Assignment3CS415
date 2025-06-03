@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Create Student Application
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Student Application</li>
                        </ol>
                    </nav>

                    @include('session-messages')

{{--                    <p class="text-primary">--}}
{{--                        <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Remember to create related "Class" and "Section" before adding student</small>--}}
{{--                    </p>--}}
                    <div class="mb-4">
                        <form class="row g-3" action="{{route('school.student.application.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="student_id_number" class="form-label">Student ID Number<sup></sup></label>
                                    <input type="text" class="form-control" id="student_id_number" name="student_id_number" placeholder="Student ID Number" required value="{{old('student_id_number')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">First Name<sup></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name" required value="{{old('first_name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Last Name<sup></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Last Name" required value="{{old('last_name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="middle_name" class="form-label">Middle Name<sup></sup></label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" required value="{{old('middle_name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputBirthday" class="form-label">Birthday<sup></sup></label>
                                    <input type="date" class="form-control" id="inputBirthday" name="birthday" placeholder="Birthday" required value="{{old('birthday')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label">Address<sup></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Lot 64, Vatuwaqa" required value="{{old('address')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="campus" class="form-label">Campus<sup></sup></label>
                                    <input type="text" class="form-control" id="campus" name="campus" placeholder="Campus" required value="{{old('campus')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="semester_year" class="form-label">Semester/Year<sup></sup></label>
                                    <input type="text" class="form-control" id="semester_year" name="semester_year" placeholder="Semester/Year" required value="{{old('semester_year')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPhone" class="form-label">Phone<sup></sup></label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="+679" required value="{{old('phone')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email<sup></sup></label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" required value="{{old('email')}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="reason_for_apply" class="form-label">Reason For Applying<sup></sup></label>
                                    <textarea class="form-control" id="reason_for_apply" name="reason_for_apply"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="documents" class="form-label">Upload Document<sup></sup></label>
                                    <input type="file" class="form-control" id="documents" multiple accept=".pdf" name="documents[]">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">What are you applying for?<sup></sup></label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="exam_type[]" id="compassionate" value="Compassionate Pass">
                                        <label class="form-check-label" for="compassionate">
                                            Compassionate Pass
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="exam_type[]" id="aegrotat" value="Aegrotat Pass">
                                        <label class="form-check-label" for="aegrotat">
                                            Aegrotat Pass
                                        </label>
                                    </div>

                                     <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="exam_type[]" id="graduation" value="Graduation">
                                        <label class="form-check-label" for="graduation">
                                            Graduation
                                        </label>
                                    </div>

                                     <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="exam_type[]" id="grades_recheck" value="Grades Recheck">
                                        <label class="form-check-label" for="grades_recheck">
                                            Grades Recheck
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="exam_type[]" id="special_exam" value="Special Examination">
                                        <label class="form-check-label" for="special_exam">
                                            Special Examination
                                        </label>
                                    </div>
                                </div>

                                <div id="exam-sections">
                                    <div class="border rounded p-3 mb-3 bg-light exam-group">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">Exam 1</h6>
                                            <button type="button" class="btn btn-sm btn-danger" disabled>&times; Remove</button>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Course Code</label>
                                                <input type="text" class="form-control" name="missed_exams[0][course_code]">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Exam Date</label>
                                                <input type="date" class="form-control" name="missed_exams[0][exam_date]">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Exam Time</label>
                                                <input type="time" class="form-control" name="missed_exams[0][exam_time]">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-success" id="add-exam-btn">
                                        <i class="bi bi-plus-circle"></i> Add Exam
                                    </button>
                                </div>


                                {{--                                <input type="hidden" name="session_id" value="{{$current_school_session_id}}">--}}
                            </div>
                            <div class="row mt-4">
                                <div class="col-12-md">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-plus"></i> Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getSections(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('inputAssignToSection');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
<script>
    let examCount = 1;

    document.getElementById('add-exam-btn').addEventListener('click', function () {
        const examSections = document.getElementById('exam-sections');

        const newExam = document.createElement('div');
        newExam.classList.add('border', 'rounded', 'p-3', 'mb-3', 'bg-light', 'exam-group');

        newExam.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Exam ${examCount + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-exam">&times; Remove</button>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Course Code</label>
                    <input type="text" class="form-control" name="missed_exams[${examCount}][course_code]">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Exam Date</label>
                    <input type="date" class="form-control" name="missed_exams[${examCount}][exam_date]">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Exam Time</label>
                    <input type="time" class="form-control" name="missed_exams[${examCount}][exam_time]">
                </div>
            </div>
        `;

        examSections.appendChild(newExam);
        examCount++;
    });

    // Delegate remove button click handler
    document.getElementById('exam-sections').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-exam')) {
            e.target.closest('.exam-group').remove();
        }
    });
</script>


@include('components.photos.photo-input')
@endsection
