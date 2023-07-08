<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Student;
use DB;

class VisitDashboardController extends Controller
{
    //
    public function home()
    {
        $studentSuggestions = Student::select('id', 'name')
                                ->get()
                                ->toJson();

        $visits = DB::table('visits')
                    ->join('students', 'visits.student_id', '=', 'students.id')
                    ->select('visits.id', 'name', 'class', 'visit_datetime', 'explanation')
                    ->get();
        return view('content.content_visits', compact('studentSuggestions', 'visits'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required',
            'explanation' => 'required',
        ]);
        // return var_dump($validatedData);
        $student = Student::where('id', $validatedData['student_id'])
                            ->first();

        $visit = $student->visit()->create($validatedData);

        return redirect()->back();
    }

    public function update(Request $request, Visit $visit)
    {
        $visit->explanation = $request->input('explanation');
        $visit->save();
        return redirect()->route('visits-dashboard');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()->route('visits-dashboard')->with('success', 'Data has been deleted successfully');
    }
}
