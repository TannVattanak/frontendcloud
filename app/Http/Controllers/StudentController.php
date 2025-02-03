<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\WorkoutPlan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Resource;
use Carbon\Carbon;

class StudentController extends Controller
{
    //
    public function welcome()
    {
        $user = Auth::user();
        $schedules = Schedule::where('id', $user->id)->with('workoutPlan')->get();
        return view('students.index', compact('user', 'schedules'));
    }

    public function resource()
    {
        $articles = Resource::where('type', 'article')->get();
        $exercises = Resource::where('type', 'exercise')->get();

        return view('students.resource', compact('articles', 'exercises'));
    }

    public function showArticle($resource_id)
    {
        $article = Resource::findOrFail($resource_id);

        // Check if the resource type is 'article'
        if ($article->type !== 'article') {
            abort(404); // Handle appropriately if the resource is not an article
        }

        return view('students.articles', compact('article'));
    }

    public function workoutplan()
    {
        $user = Auth::user();
        $workoutPlans = WorkoutPlan::all();

        return view('students.workoutplan', compact('workoutPlans'));
    }

    public function coursedetail($workoutplan_id)
    {
        $workoutPlan = WorkoutPlan::with('user')->find($workoutplan_id);

        if (!$workoutPlan) {
            return redirect()->route('students.workoutplan')->with('error', 'Workout plan not found.');
        }

        return view('students.course-detail', compact('workoutPlan'));
    }

    //under development
    public function payment()
    {
        return view('students.payment');
    }

    public function progress()
    {
        $userId = auth()->id(); // assuming you are fetching data for the authenticated user

        $progresses = Progress::where('id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDays(15)->startOfDay())
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        $allProgresses = Progress::where('id', $userId)
            ->orderBy('created_at', 'desc') // Fetch latest first for all records
            ->get();

        $totalWorkouts = $allProgresses->count();
        $totalKcal = $allProgresses->sum('calories_burn');
        $totalTime = $allProgresses->sum('workout_duration');

        return view('students.progress', compact('progresses', 'allProgresses', 'totalWorkouts', 'totalKcal', 'totalTime'));
    }

    public function index(Request $request): View
    {
        return view('students/profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('students/profile.edit', [
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

        return Redirect::route('profile.indexForstudent')->with('status', 'profile-updated');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
