<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

public function store(Request $request)
{
    $validatedData = $request->validate([
        'fullname' => 'required|string',
        'cv_file' => 'required|file',
        'image_file' => 'required|file',
    ]);
    
    $cv_file = $request->file('cv_file')->store('public/cv_files');
    $image_file = $request->file('image_file')->store('public/images');
    
    $userData = new UserData();
    $userData->fullname = $validatedData['fullname'];
    $userData->cv_file = $cv_file;
    $userData->image_file = $image_file;
    $userData->save();
    
    return redirect('/')->with('success', 'Data submitted successfully!');
}
