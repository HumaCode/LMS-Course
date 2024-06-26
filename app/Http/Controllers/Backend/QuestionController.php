<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function userQuestion(Request $request)
    {
        if (Auth::check()) {


            $attr = $request->validate([
                'course_id'     => 'required',
                'instructor_id' => 'required',
                'subject'       => 'required',
                'question'      => 'required',
            ]);

            $course_id      = $attr['course_id'];
            $instructor_id  = $attr['instructor_id'];

            Question::insert([
                'course_id'     => $course_id,
                'instructor_id' => $instructor_id,
                'user_id'       => Auth::user()->id,
                'subject'       => $attr['subject'],
                'question'      => $attr['question'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);

            $notification = [
                'message'       => 'Message Send Successfully',
                'alert-type'    => 'success',
            ];

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message'       => 'You Need to Login First',
                'alert-type'    => 'error',
            ];

            return redirect()->route('login')->with($notification);
        }
    }

    public function instructorAllQuestion()
    {
        $title          = 'All Question';
        $subtitle       = 'all question';
        $id             = Auth::user()->id;
        $question       = Question::with('user', 'course')->where('instructor_id', $id)->where('parent_id', null)->orderBy('id', 'desc')->get();

        return view('instructor.question.all_question', compact('question', 'title', 'subtitle'));
    }

    public function instructorQuestionDetail($id)
    {
        $title          = 'Question Details';
        $subtitle       = 'question details';
        $question       = Question::findOrFail($id);
        $replay         = Question::where('parent_id', $id)->orderBy('id', 'asc')->get();

        return view('instructor.question.question_details', compact('question', 'replay', 'title', 'subtitle'));
    }

    public function instructorReplay(Request $request)
    {
        $que_id         = $request->qid;
        $user_id        = $request->user_id;
        $course_id      = $request->course_id;
        $instructor_id  = $request->instructor_id;
        $instructor_id  = $request->instructor_id;

        $attr = $request->validate([
            'question'    => 'required',
        ]);

        Question::insert([
            'course_id'     => $course_id,
            'user_id'       => $user_id,
            'instructor_id' => $instructor_id,
            'parent_id'     => $que_id,
            'question'      => $attr['question'],
            'created_at'    => Carbon::now()
        ]);

        $notification = [
            'message'       => 'Message Send Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('instructor.all.question')->with($notification);
    }
}
