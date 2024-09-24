<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $medias = Media::where('user_id', Auth::user()->id)->get();
        return view('index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medias   = Media::where('user_id', Auth::id())->get();
        return view('create', compact('medias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'audio' => 'mimes:mp3|max:10240|nullable',
            'video' => 'mimes:mp4|max:51200|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        //handle image

        $image = $request->image;
        $image_new_name = time(). '_' . $image->getClientOriginalName();

        $image->move('uploads/images',$image_new_name);
        $imagepath = 'uploads/images/' . $image_new_name;

        // Handle video upload
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videofile = $request->file('video');
            $videoNewName = time() . '_' . $videofile->getClientOriginalName();
            $videofile->move(public_path('uploads/videos'), $videoNewName);
            $videoPath = 'uploads/videos/' . $videoNewName;
        }

        // Handle audio upload
        $audioPath = null;
        if ($request->hasFile('audio')) {
            $audioFile = $request->file('audio');
            $audioNewName = time() . '_' . $audioFile->getClientOriginalName();
            $audioFile->move(public_path('uploads/audios'), $audioNewName);
            $audioPath = 'uploads/audios/' . $audioNewName;
        }




        // Save the media details in the database
        $media = Media::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'audio_path' => $audioPath,
            'video_path' => $videoPath,
            'image'=> $imagepath,
        ]);

        flash('Your Media is Created Successfully.');
        return redirect()->route('medias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $media = Media::find($id);
        return view('edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function update(Request $request, $id)
     {
         $request->validate([
             'title' => 'required',
             'audio' => 'mimes:mp3|max:10240|nullable',
             'video' => 'mimes:mp4|max:51200|nullable',
             'image'=>  'nullable|image|mimes:jpeg,png,jpg,gif'
         ]);

         // Find the media entry by ID
         $media = Media::find($id);

         if (!$media) {
             return redirect()->route('medias.index')->withErrors('Media not found.');
         }

         //handle the images

         if ($request->hasFile('image')) {
            if ($media->image && file_exists(public_path($media->image))) {
                unlink(public_path($media->image));
            }

            $newImageFile = $request->file('image');
            $newImageName = time() . '_' . $newImageFile->getClientOriginalName();
            $newImageFile->move(public_path('uploads/videos'), $newImageName);

            $media->image = 'uploads/videos/' . $newImageName;
        }


         // Handle video update if a new file is uploaded
         if ($request->hasFile('video')) {
             if ($media->video_path && file_exists(public_path($media->video_path))) {
                 unlink(public_path($media->video_path));
             }

             $newVideoFile = $request->file('video');
             $newVideoName = time() . '_' . $newVideoFile->getClientOriginalName();
             $newVideoFile->move(public_path('uploads/videos'), $newVideoName);

             $media->video_path = 'uploads/videos/' . $newVideoName;
         }

         // Handle audio update if a new file is uploaded
         if ($request->hasFile('audio')) {
             if ($media->audio_path && file_exists(public_path($media->audio_path))) {
                 unlink(public_path($media->audio_path));
             }

             $newAudioFile = $request->file('audio');
             $newAudioName = time() . '_' . $newAudioFile->getClientOriginalName();
             $newAudioFile->move(public_path('uploads/audios'), $newAudioName);

             $media->audio_path = 'uploads/audios/' . $newAudioName;
         }

         // **Clear video/audio if the user requests it**
         if ($request->has('clear_video')) {
             if ($media->video_path && file_exists(public_path($media->video_path))) {
                 unlink(public_path($media->video_path));
             }
             $media->video_path = null;
         }

         if ($request->has('clear_audio')) {
             if ($media->audio_path && file_exists(public_path($media->audio_path))) {
                 unlink(public_path($media->audio_path));
             }
             $media->audio_path = null;
         }


         // Update the title even if no new files are uploaded
         $media->title = $request->title;

         // Save the changes to the database
         $media->save();

         flash('Your Media has been updated successfully.');
         return redirect()->route('medias.index');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $media = Media::find($id);
        $media->delete();
        flash('Your Media is Deleted Successfully.');
        return redirect()->route('medias.index');
    }

    // public function download($id)
    // {
    //     $medias = Media::find($id);
    //     $filePath = public_path($medias->audio_path);

    //     if (file_exists($filePath)) {
    //         return response()->download($filePath);
    //     } else {
    //         return redirect()->back()->with('error', 'File not found.');
    //     }
    // }
}
