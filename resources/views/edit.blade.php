@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Media: {{ $media->title }}</h6>
                <form action="{{ route('medias.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Title" name="title"
                            value="{{ $media->title }}" required>
                        <label for="title">Title</label>
                    </div>

                    <!-- Audio File Field -->
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" placeholder="Audio file" name="audio">
                        <label for="audio">Audio File</label>
                    </div>

                    <!-- Display current audio if exists -->
                    @if ($media->audio_path)
                        <p>Current audio: <a href="{{ asset($media->audio_path) }}" target="_blank">Listen to Audio</a></p>
                        <label>
                            <input type="checkbox" name="clear_audio"> Remove current audio
                        </label>
                    @endif
                    <br>
                    <br>
                    <br>
                    <!-- Video File Field -->
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" placeholder="Video file" name="video">
                        <label for="video">Video File</label>
                    </div>


                    <!-- Display current video if exists -->
                    @if ($media->video_path)
                        <p>Current video: <a href="{{ asset($media->video_path) }}" target="_blank">Watch Video</a></p>
                        <label>
                            <input type="checkbox" name="clear_video"> Remove current video
                        </label>
                    @endif

                    <!-- Submit Button -->
                    <div class="form-group text-center">
                        <button class="btn btn-success" type="submit">Update Media</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection
