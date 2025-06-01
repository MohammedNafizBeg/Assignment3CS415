<?php

namespace App\Http\Controllers;

use App\Models\MissedExamDetail;
use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StudentApplicationController extends Controller
{
    public function createApplication()
    {
        return view('studentApplication.add');
    }
    public function storeStudentApplication(Request $request)
    {

        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');

            if (!is_array($documents)) {
                $documents = [$documents];
            }

            foreach ($documents as $file) {
                if ($file && $file->isValid()) {
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('storage/documents'), $filename);
                    $savedDocs[] = 'documents/' . $filename;
                }
            }
        }

        foreach ($request->exam_type as $exam_type) {
            $student_application = new StudentApplication();
            $student_application->user_id = \auth()->user()->id;
            $student_application->student_id_number = $request->student_id_number;
            $student_application->first_name = $request->first_name;
            $student_application->last_name = $request->last_name;
            $student_application->middle_name = $request->middle_name;
            $student_application->date_of_birth = $request->birthday;
            $student_application->address = $request->address;
            $student_application->campus = $request->campus;
            $student_application->semester_year = $request->semester_year;
            $student_application->telephone = $request->phone;
            $student_application->email = $request->email;
            $student_application->reason_for_apply = $request->reason_for_apply;
            $student_application->exam_type = $exam_type;
            $student_application->documents = json_encode($savedDocs); // reused
            $student_application->missed_exams = json_encode($request->missed_exams);

            $student_application->save();
//            foreach ($request->missed_exams as $missed_exam) {
//                $MissedExamDetail = new MissedExamDetail();
//                $MissedExamDetail->application_id = $student_application->id;
//                $MissedExamDetail->course_code = $missed_exam['course_code'];
//                $MissedExamDetail->exam_date = $missed_exam['exam_date'];
//                $MissedExamDetail->exam_time = $missed_exam['exam_time'];
//                $MissedExamDetail->save();
//            }
        }

        return redirect()->back()->with('status', 'Application has been created.');
    }

    public function getStudentApplicationList()
    {
        if(Auth::user()->role == "admin"){
            $applications = StudentApplication::all();
        }
        if(Auth::user()->role == "student"){
            $applications = StudentApplication::where('user_id', auth()->user()->id)->get();
        }
        return view('studentApplication.list', ['applications' => $applications]);
    }

    public function updateStatus(Request $request)
    {
        $application = StudentApplication::find($request->id);
        $application->status = $request->status;
        $application->save();

        try {
            Mail::raw("Your application status has been Marked as: {$application->status}", function ($message) use ($application) {
                $message->to($application->email)
                    ->subject('Application Status Updated');
            });
        }
        catch (\Exception $exception){
            dd($exception->getMessage());
        }

        return response()->json(['success' => true]);
    }

    public function editStudentApplication($id)
    {
        $student_application = StudentApplication::find($id)->first();
        return view('studentApplication.edit', ['student_application' => $student_application]);
    }

    public function updateStudentApplication(Request $request)
    {
        $student_application = StudentApplication::find($request->id);

        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');

            if (!is_array($documents)) {
                $documents = [$documents];
            }

            foreach ($documents as $file) {
                if ($file && $file->isValid()) {
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('storage/documents'), $filename);
                    $savedDocs[] = 'documents/' . $filename;
                }
            }
        }

        foreach ($request->exam_type as $exam_type) {
            $student_application->user_id = \auth()->user()->id;
            $student_application->student_id_number = $request->student_id_number;
            $student_application->first_name = $request->first_name;
            $student_application->last_name = $request->last_name;
            $student_application->middle_name = $request->middle_name;
            $student_application->date_of_birth = $request->birthday;
            $student_application->address = $request->address;
            $student_application->campus = $request->campus;
            $student_application->semester_year = $request->semester_year;
            $student_application->telephone = $request->phone;
            $student_application->email = $request->email;
            $student_application->reason_for_apply = $request->reason_for_apply;
            $student_application->exam_type = $exam_type;
            if (isset($savedDocs)){
                $student_application->documents = json_encode($savedDocs); // reused
            }
            $student_application->missed_exams = json_encode($request->missed_exam);
            $student_application->save();
//            foreach ($request->missed_exams as $missed_exam) {
//                $MissedExamDetail = new MissedExamDetail();
//                $MissedExamDetail->application_id = $student_application->id;
//                $MissedExamDetail->course_code = $missed_exam['course_code'];
//                $MissedExamDetail->exam_date = $missed_exam['exam_date'];
//                $MissedExamDetail->exam_time = $missed_exam['exam_time'];
//                $MissedExamDetail->save();
//            }
        }

        return redirect()->back()->with('status', 'Application has been created.');
    }
}
