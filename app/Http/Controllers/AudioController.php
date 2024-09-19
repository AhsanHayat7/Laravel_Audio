<?php

namespace App\Http\Controllers;

use App\models\AudioFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ public function index()
    {
        $audios = AudioFile::all();
        return view('index', compact('audios'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'audio' => 'required|mimes:mp3|max:10240'
        ]);

        $audioFile = $request->file('audio');

        // Create a new filename with timestamp
        $audioNewName = time() . '_' . $audioFile->getClientOriginalName();

        // Move the audio file to the 'uploads/audios' directory
        $audioFile->move(public_path('uploads/audios'), $audioNewName);

        // Save the audio details in the database
        $audio = AudioFile::create([
            'title' => $request->title,
            'file_path' => 'uploads/audios/' . $audioNewName, // Save the file path
        ]);
        return redirect()->route('audios.index');
    }

    public function show($id)
    {
        $audio = AudioFile::findOrFail($id);
        return view('show', compact('audio'));
    }

    public function edit($id)
    {
        $audio = AudioFile::findOrFail($id);
        return view('edit', compact('audio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'audio' => 'mimes:mp3|max:10240'
        ]);

        $audio = AudioFile::findOrFail($id);

    // If a new audio file is uploaded
    if ($request->hasFile('audio')) {
        // Delete the old audio file
        if (file_exists(public_path($audio->file_path))) {
            unlink(public_path($audio->file_path));
        }

        // Get the new audio file
        $newAudioFile = $request->file('audio');

        // Create a new filename with timestamp
        $newAudioName = time() . '_' . $newAudioFile->getClientOriginalName();

        // Move the new audio file to the 'uploads/audios' directory
        $newAudioFile->move(public_path('uploads/audios'), $newAudioName);

        // Update the file path in the database
        $audio->file_path = 'uploads/audios/' . $newAudioName;
    }

    // Update the audio title
    $audio->title = $request->title;
    $audio->save();

        return redirect()->route('audios.index');
    }

    public function destroy($id)
    {
        $audio = AudioFile::findOrFail($id);
        Storage::delete($audio->file_path);
        $audio->delete();

        return redirect()->route('audios.index');
    }

    public function download($id)
    {
        $audio = AudioFile::findOrFail($id);
        $filePath = public_path($audio->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function dashboard(){
        return view('dashboard');
    }
}
