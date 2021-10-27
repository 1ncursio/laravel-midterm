<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClassController extends Controller {
    //
    public function index() {
        $subjects = Auth::user()->subjects();
        $paginatedSubjects = $subjects->with('users')->paginate(5);
        // error_log($subjects->pivot);
        return Inertia::render('Classes/Index', ['subjects' => $paginatedSubjects, 'length' => $subjects->count()]);
    }
}
