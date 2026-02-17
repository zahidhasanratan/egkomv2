<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\HomepageHeroSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomepageHeroController extends Controller
{
    /**
     * Show the form for editing the homepage hero (video, title, subtitle).
     */
    public function edit()
    {
        $hero = HomepageHeroSetting::get();
        return view('auth.super_admin.homepage_hero.edit', compact('hero'));
    }

    /**
     * Update the homepage hero settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'subtitle'=> 'required|string|max:500',
            'video'   => 'nullable|file|mimes:mp4,webm,ogg,mov|max:102400', // max 100MB
        ]);

        $hero = HomepageHeroSetting::get();

        $data = [
            'title'    => strip_tags($request->title, '<strong><em><b><i><br>'),
            'subtitle' => strip_tags($request->subtitle),
        ];

        if ($request->hasFile('video')) {
            $uploadPath = public_path('uploads/homepage_hero');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            $file = $request->file('video');
            $name = 'hero-' . date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $name);
            $data['video_path'] = 'uploads/homepage_hero/' . $name;

            // Optionally remove old uploaded file (if it was under uploads/homepage_hero/)
            $oldPath = $hero->video_path;
            if ($oldPath && str_starts_with($oldPath, 'uploads/homepage_hero/') && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
        }

        $hero->update($data);

        return redirect()->route('super-admin.homepage-hero.edit')
            ->with('success', 'Homepage hero (video, title & subtitle) updated successfully.');
    }
}
