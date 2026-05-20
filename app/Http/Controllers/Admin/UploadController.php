<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:5120',
        ]);

        $path = $request->file('file')->store('editor', 'public');

        return response()->json(['location' => asset('storage/' . $path)]);
    }
}
