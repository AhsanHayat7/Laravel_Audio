<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $media = Media::get();
        return $this->successResponse($media);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaRequest $request)
    {
        //
        $user = Auth::user();
        // Validate request
        $validated = $request->validated();


        if ($request->hasFile('image')) {
            $imagefile = $request->file('image');
            $imageNewName = time() . '_' . $imagefile->getClientOriginalName();
            $imagefile->move(public_path('uploads/images'), $imageNewName);
            $validated['image'] = 'uploads/images/' . $imageNewName;
        }
        // Handle video upload

        if ($request->hasFile('video')) {
            $videofile = $request->file('video');
            $videoNewName = time() . '_' . $videofile->getClientOriginalName();
            $videofile->move(public_path('uploads/videos'), $videoNewName);
            $validated['video_path'] = 'uploads/videos/' . $videoNewName;
        }

        // Handle audio upload

        if ($request->hasFile('audio')) {
            $audioFile = $request->file('audio');
            $audioNewName = time() . '_' . $audioFile->getClientOriginalName();
            $audioFile->move(public_path('uploads/audios'), $audioNewName);
            $validated['audio_path'] = 'uploads/audios/' . $audioNewName;
        }

        // Associate the post with the authenticated user
        $validated['user_id'] = $user->id;

        // Create the media
        $media = Media::create($validated);

        return $this->successResponse($media, 'New Medias Created!', 201);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = Media::find($id)->get();
        if (!$media) {
            return $this->errorResponse('Post Not Found or Unauthorized', 404);
        }

        return $this->successResponse($media);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, $id)
    {
        //
        $media = Media::find($id);
        if (!$media) {
            return $this->errorResponse('Post Not Found or Unauthorized', 404);
        }


        $validated = $request->validated();


        if ($request->hasFile("image")) {

            $image = $request->image;

            $images_new_name = time() . '_' .  $image->getClientOriginalName();

            $image->move('uploads/images/', $images_new_name);

            $media->image = 'uploads/images/' . $images_new_name;
        }

        // Handle video update if a new file is uploaded


        if ($request->hasFile('video')) {
            if ($media->video_path && file_exists(public_path($media->video_path))) {
                unlink(public_path($media->video_path));
            }

            $newVideoFile = $request->file('video');
            $newVideoName = time() . '_' . $newVideoFile->getClientOriginalName();
            $newVideoFile->move(public_path('uploads/videos'), $newVideoName);

            $validated['video_path'] = 'uploads/videos/' . $newVideoName;
        }

        // Handle audio update if a new file is uploaded
        if ($request->hasFile('audio')) {
            if ($media->audio_path && file_exists(public_path($media->audio_path))) {
                unlink(public_path($media->audio_path));
            }

            $newAudioFile = $request->file('audio');
            $newAudioName = time() . '_' . $newAudioFile->getClientOriginalName();
            $newAudioFile->move(public_path('uploads/audios'), $newAudioName);

            $validated['audio_path'] = 'uploads/audios/' . $newAudioName;
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
        $media->update($validated);

        return $this->successResponse($media, 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $media = Media::find($id);

        if (!$media) {
            return $this->errorResponse('Post Not Found or Unauthorized', 404);
        }

        // Delete the image if it exists
        if ($media->audio_path && file_exists(public_path($media->audio_path))) {
            unlink(public_path($media->audio_path));
        }

        if ($media->video_path && file_exists(public_path($media->video_path))) {
            unlink(public_path($media->video_path));
        }

        // Delete the post
        $media->delete();

        return $this->successResponse(null, 'Media Deleted', 200);
    }
}
