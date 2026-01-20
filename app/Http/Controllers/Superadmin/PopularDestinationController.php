<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\PopularDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopularDestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = PopularDestination::latest()->paginate(10);
        return view('auth.super_admin.popular_destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.super_admin.popular_destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120', // 5MB max
            'video_url' => 'nullable|url|max:500',
        ]);

        // Ensure only one of image or video_url is provided
        if ($request->hasFile('image') && $request->filled('video_url')) {
            return back()->withErrors(['error' => 'You can only provide either an image OR a video URL, not both.'])->withInput();
        }

        if (!$request->hasFile('image') && !$request->filled('video_url')) {
            return back()->withErrors(['error' => 'You must provide either an image or a video URL.'])->withInput();
        }

        $data = [
            'name' => $validated['name'],
        ];

        if ($request->hasFile('image')) {
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/popular_destinations');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Get file and generate unique name
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            
            $data['feature_photo'] = 'uploads/popular_destinations/' . $fileName;
            $data['feature_video'] = null;
            $data['media_type'] = 'image';
        } else {
            $data['feature_video'] = $validated['video_url'];
            $data['feature_photo'] = null;
            $data['media_type'] = 'video';
        }

        PopularDestination::create($data);

        return redirect()->route('super-admin.popular-destinations.index')
            ->with('success', 'Popular destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $destination = PopularDestination::findOrFail($id);
        return view('auth.super_admin.popular_destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $destination = PopularDestination::findOrFail($id);
        return view('auth.super_admin.popular_destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $destination = PopularDestination::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120', // 5MB max
            'video_url' => 'nullable|url|max:500',
            'media_type' => 'nullable|in:image,video',
        ]);

        // Get media type from request or determine from inputs
        $mediaType = $request->input('media_type') ?? $request->input('media_type_selected');
        $hasImage = $request->hasFile('image');
        $videoUrl = trim($request->input('video_url', ''));
        $hasVideoUrl = !empty($videoUrl) && filter_var($videoUrl, FILTER_VALIDATE_URL);

        // If image is uploaded, ignore video_url even if it's filled (it might be from form state)
        // If video is selected and has valid URL, ignore image
        if ($hasImage && $hasVideoUrl && $mediaType !== 'video') {
            // Clear video URL since image is being uploaded
            $hasVideoUrl = false;
            $videoUrl = '';
        } elseif ($hasVideoUrl && !$hasImage && $mediaType === 'video') {
            // Valid video URL provided
        } elseif ($hasImage && $hasVideoUrl) {
            // Both provided and no clear media type - error
            return back()->withErrors(['error' => 'You can only provide either an image OR a video URL, not both.'])->withInput();
        }

        $data = [
            'name' => $validated['name'],
        ];

        // Determine media type based on what's provided
        if ($hasImage) {
            // Delete old image if exists
            if ($destination->feature_photo && file_exists(public_path($destination->feature_photo))) {
                unlink(public_path($destination->feature_photo));
            }
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/popular_destinations');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Get file and generate unique name
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            
            $data['feature_photo'] = 'uploads/popular_destinations/' . $fileName;
            $data['feature_video'] = null;
            $data['media_type'] = 'image';
        } elseif ($hasVideoUrl) {
            // Delete old image if exists (since we're replacing with video)
            if ($destination->feature_photo && file_exists(public_path($destination->feature_photo))) {
                unlink(public_path($destination->feature_photo));
            }
            $data['feature_video'] = trim($validated['video_url']);
            $data['feature_photo'] = null;
            $data['media_type'] = 'video';
        } elseif ($mediaType) {
            // If media_type is selected but no new file/url, update the media_type only
            $data['media_type'] = $mediaType;
            // Clear the opposite media type if switching
            if ($mediaType === 'image' && $destination->feature_video) {
                $data['feature_video'] = null;
                $data['feature_photo'] = null; // Will need new image upload
            } elseif ($mediaType === 'video' && $destination->feature_photo) {
                // Delete old image when switching to video
                if (file_exists(public_path($destination->feature_photo))) {
                    unlink(public_path($destination->feature_photo));
                }
                $data['feature_photo'] = null;
                $data['feature_video'] = null; // Will need new video URL
            }
        }
        // If neither is provided and no media_type change, keep existing values

        $destination->update($data);

        return redirect()->route('super-admin.popular-destinations.index')
            ->with('success', 'Popular destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $destination = PopularDestination::findOrFail($id);

        // Delete image if exists
        if ($destination->feature_photo && file_exists(public_path($destination->feature_photo))) {
            unlink(public_path($destination->feature_photo));
        }

        $destination->delete();

        return redirect()->route('super-admin.popular-destinations.index')
            ->with('success', 'Popular destination deleted successfully.');
    }
}
