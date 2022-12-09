<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            "images" => "required|file|image",
        ]);

        $path = $request->file("images")->store("images");

        $image = Image::create([
            'path' => $path,
            'project_id' => 0
        ]);

        return $image;
    }

    public function delete(Request $request)
    {
        $image = Image::firstWhere("id", $request->getContent());

        Storage::delete($image->path);

        $image->delete();
    }
}
