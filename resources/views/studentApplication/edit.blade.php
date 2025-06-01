@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Edit Application
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Student Application</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Application</li>
                        </ol>
                    </nav>

                    @include('session-messages')
                    <div class="mb-4">
                        <form class="row g-3" action="{{route('school.student.application.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $student_application->id }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="student_id_number" class="form-label">Student ID Number<sup></sup></label>
                                    <input type="text" class="form-control" id="student_id_number" name="student_id_number" placeholder="Student ID Number" required value="{{ $student_application->student_id_number }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">First Name<sup></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name" required value="{{ $student_application->first_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Last Name<sup></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Last Name" required value="{{ $student_application->last_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="middle_name" class="form-label">Middle Name<sup></sup></label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" required value="{{ $student_application->middle_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputBirthday" class="form-label">Birthday<sup></sup></label>
                                    <input type="date" class="form-control" id="inputBirthday" name="birthday" placeholder="Birthday" required value="{{ $student_application->date_of_birth }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label">Address<sup></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="634 Main St" required value="{{ $student_application->address }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="campus" class="form-label">Campus<sup></sup></label>
                                    <input type="text" class="form-control" id="campus" name="campus" placeholder="Campus" required value="{{ $student_application->campus }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="semester_year" class="form-label">Semester/Year<sup></sup></label>
                                    <input type="text" class="form-control" id="semester_year" name="semester_year" placeholder="Semester/Year" required value="{{ $student_application->semester_year }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPhone" class="form-label">Phone<sup></sup></label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="+880 01......" required value="{{ $student_application->telephone }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email<sup></sup></label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" required value="{{ $student_application->email }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="reason_for_apply" class="form-label">Reason For Applying<sup></sup></label>
                                    <textarea class="form-control" id="reason_for_apply" name="reason_for_apply">{{ $student_application->reason_for_apply }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="documents" class="form-label">Upload Document<sup></sup></label>
                                    <input type="file" class="form-control" id="documents" multiple accept=".pdf" name="documents[]">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">What are you applying for?<sup></sup></label>


                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="exam_type[]" {{ in_array('Compassionate Pass', (array) $student_application->exam_type) ? 'checked' : '' }} id="compassionate" value="Compassionate Pass">
                                        <label class="form-check-label" for="compassionate">
                                            Compassionate Pass
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" {{ in_array('Aegrotat Pass', (array) $student_application->exam_type) ? 'checked' : '' }} type="checkbox" name="exam_type[]" id="aegrotat" value="Aegrotat Pass">
                                        <label class="form-check-label" for="aegrotat">
                                            Aegrotat Pass
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" {{ in_array('Special Examination', (array) $student_application->exam_type) ? 'checked' : '' }} type="checkbox" name="exam_type[]" id="special_exam" value="Special Examination">
                                        <label class="form-check-label" for="special_exam">
                                            Special Examination
                                        </label>
                                    </div>
                                </div>
                                @php
                                    $missed_exams = json_decode($student_application->missed_exams);
                                @endphp

                                <div id="exam-sections">
                                    @foreach($missed_exams as $index => $missed_exam)
                                        <div class="border rounded p-3 mb-3 bg-light exam-group">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">Exam {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-exam" {{ $index === 0 ? 'disabled' : '' }}>&times; Remove</button>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Course Code</label>
                                                    <input type="text" class="form-control" value="{{ $missed_exam->course_code }}" name="missed_exams[{{ $index }}][course_code]">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Exam Date</label>
                                                    <input type="date" class="form-control" value="{{ $missed_exam->exam_date }}" name="missed_exams[{{ $index }}][exam_date]">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Exam Time</label>
                                                    <input type="time" class="form-control" value="{{ $missed_exam->exam_time }}" name="missed_exams[{{ $index }}][exam_time]">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
@include('components.photos.photo-input')
<script>
    let examCount = document.querySelectorAll('.exam-group').length;

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
            const examGroup = e.target.closest('.exam-group');

            // Prevent removing the first (initial) one if needed
            if (examGroup.querySelector('.remove-exam').disabled) return;

            examGroup.remove();
            reindexExams();
        }
    });

    function reindexExams() {
        const examGroups = document.querySelectorAll('#exam-sections .exam-group');
        examGroups.forEach((group, index) => {
            group.querySelector('h6').textContent = `Exam ${index + 1}`;

            const inputs = group.querySelectorAll('input');
            inputs[0].name = `missed_exams[${index}][course_code]`;
            inputs[1].name = `missed_exams[${index}][exam_date]`;
            inputs[2].name = `missed_exams[${index}][exam_time]`;

            const removeBtn = group.querySelector('.remove-exam');
            removeBtn.disabled = (index === 0);
        });

        examCount = examGroups.length;
    }
</script>

@endsection
