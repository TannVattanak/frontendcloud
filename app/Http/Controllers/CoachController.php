<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Resource;


class CoachController extends Controller
{
    //
    public function welcome()
    {
        $user = Auth::user();
        $schedules = Schedule::where('id', $user->id)->with('workoutPlan')->get();
        return view('coaches.index', compact('user', 'schedules'));
    }

    public function deleteStudent(User $student)
    {
        $coach = Auth::user();
        $coach->students()->detach($student->id);

        return redirect()->back()->with('success', 'Student removed successfully.');
    }
    public function schedule(User $student)
    {
        $schedules = $student->schedules()->with('workoutPlan')->get();

        return view('coaches.schedule', compact('student', 'schedules'));
    }

    // public function progress()
    // {
    //     $userId = auth()->id(); // assuming you are fetching data for the authenticated user

    //     $progresses = Progress::where('id', $userId)
    //         ->where('created_at', '>=', Carbon::now()->subDays(7)->startOfDay())
    //         ->orderBy('created_at', 'desc')
    //         ->take(7)
    //         ->get();


    //     $allProgresses = Progress::where('id', $userId)
    //         ->orderBy('created_at', 'desc') // Fetch latest first for all records
    //         ->get();

    //     $totalWorkouts = $allProgresses->count();
    //     $totalKcal = $allProgresses->sum('calories_burn');
    //     $totalTime = $allProgresses->sum('workout_duration');

    //     return view('coaches.progress', compact('progresses', 'allProgresses', 'totalWorkouts', 'totalKcal', 'totalTime'));
    // }

    public function resource()
    {
        $articles = Resource::where('type', 'article')->get();
        $exercises = Resource::where('type', 'exercise')->get();

        return view('coaches.resource', compact('articles', 'exercises'));
    }

    public function showArticle($resource_id)
    {
        $article = Resource::findOrFail($resource_id);

        // Check if the resource type is 'article'
        if ($article->type !== 'article') {
            abort(404); // Handle appropriately if the resource is not an article
        }

        return view('coaches.articles', compact('article'));
    }
    public function report()
    {
        return view('coaches.report');
    }

    public function storeReport(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'calories_burnt' => 'required|integer',
            'workout_duration' => 'required|integer',
            'workout_sets' => 'required|integer',
            'status' => 'required|string',
            'date' => 'required|date',
        ]);

        Progress::create([
            'id' => $request->input('student_id'),
            'calories_burn' => $request->input('calories_burnt'),
            'workout_duration' => $request->input('workout_duration'),
            'workout_set' => $request->input('workout_sets'),
            'status' => $request->input('status'),
            'created_at' => $request->input('date'),
            'updated_at' => $request->input('date'),
        ]);

        return redirect()->route('coaches.report')->with('success', 'Progress report submitted successfully!');
    }

    public function index(Request $request): View
    {
        return view('coaches/profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('coaches/profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('image')) {
            // Delete old profile image if exists
            if ($user->image) {
                $oldImagePath = public_path('uploads/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store new profile image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);
            $user->image = $filename;
        }

        $user->save();

        return Redirect::route('profile.indexForcoach')->with('status', 'profile-updated');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
