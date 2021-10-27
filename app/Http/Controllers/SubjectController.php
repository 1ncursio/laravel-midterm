<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SubjectController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $subjects = Subject::latest()->paginate(5);
        return Inertia::render('Subjects/Index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return Inertia::render('Subjects/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required',
            'credit' => 'required|integer',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'description' => $request->description,
            'credit' => $request->credit,
        ]);
        error_log($subject);
        return Redirect::route('subjects.show', $subject);
    }

    public function storeUser(Subject $subject) {
        $subject->users()->attach(Auth::id());
    }

    public function destroyUser(Subject $subject) {
        $subject->users()->detach(Auth::id());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject) {
        // $subject->load(['user', 'images', 'comments.user']);
        // $subject->load('images');
        // $subject->load('comments');
        $takers =  $subject->users()->get();

        return Inertia::render('Subjects/Show', ['subject' => $subject, 'takers' => $takers]);
    }

    public function indexUserSubjects(Subject $subject) {
        // $user = User::find(Auth::user()->id);
        // error_log($user->subjects());
        // error_log(
        //     $user->subjects()
        // );
        // return Auth::user()->subjects();
        $subjects = Auth::user()->subjects;
        return Inertia::render('Classes/Index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject) {
        // $subject->load('user');

        return Inertia::render('Subjects/Edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject) {
        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required',
            'credit' => 'required|integer',
        ]);

        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->credit = $request->credit;
        $subject->save();

        return Redirect::route('subjects.show', $subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject) {
        $subject->delete();
    }
}
