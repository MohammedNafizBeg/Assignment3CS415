@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-file-text"></i> Student Applications
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Student Applications</li>
                            </ol>
                        </nav>
                        <h6>Filter list by:</h6>
                        <div class="mb-4 mt-4">
                            <form action="{{route('exam.list.show')}}" method="GET">
                                <div class="row">
                                    <div class="col-3">
                                        <select class="form-select" aria-label="Class" name="class_id">

                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-select" aria-label="Status" name="semester_id">

                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Load List</button>
                                    </div>
                                </div>
                            </form>
                            <div class="bg-white mt-4 p-3 border shadow-sm table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Stdent ID</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Campus</th>
                                        <th scope="col">Semester/Year</th>
                                        <th scope="col">Telephone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Exam Type</th>
                                        <th scope="col">Documents</th>
                                        @if(Auth::user()->role != "student")
                                        <th scope="col">Status</th>
                                        @endif
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($applications as $application)
                                        @php
                                        $documents = json_decode($application->documents);
                                        @endphp
                                        <tr>
                                            <td>{{ $application->student_id_number }}</td>
                                            <td>{{ $application->first_name }}</td>
                                            <td>{{ $application->date_of_birth }}</td>
                                            <td>{{ $application->campus }}</td>
                                            <td>{{ $application->semester_year }}</td>
                                            <td>{{ $application->telephone }}</td>
                                            <td>{{ $application->email }}</td>
                                            <td>{{ $application->exam_type }}</td>
                                            <td>
                                                @foreach($documents as $document)
                                                    <a href="{{ asset('storage/'.$document) }}" target="_blank">{{ basename($document) }}</a>
                                                    <br>
                                                @endforeach
                                            </td>
                                            @if(Auth::user()->role != "student")
                                            <td>
                                                <div class="col-md-6" style="width: 140px !important;">
                                                    <select id="application_status" class="form-select application_status" data-id="{{ $application->id }}" name="gender" required>
                                                        <option value="approved" {{ $application->status == 'approved' ? 'selected' : ''}}>Approved</option>
                                                        <option value="pending" {{ $application->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : ''}}>Rejected</option>
                                                    </select>
                                                </div>
                                            </td>
                                            @endif
                                            <td>
                                                <div class="btn-group" role="group">
                                                        <a href="{{route('student.application.edit.show', ['id' => $application->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-pen"></i> Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function (){

           $('.application_status').on('change',function (){
               const applicationId = $(this).data('id');
               const newStatus = $(this).val();

               var url = '{{ url('school/student-applications/update-status') }}'

               $.ajax({
                   url: url, // Adjust to your actual route
                   method: 'POST',
                   data: {
                       _token: '{{ csrf_token() }}',
                       id: applicationId,
                       status: newStatus
                   },
                   success: function (response) {
                       toastr.success('Status updated successfully!');
                   },
                   error: function (xhr) {
                       alert('Error updating status');
                   }
               });
           })
        });
    </script>
@endsection
