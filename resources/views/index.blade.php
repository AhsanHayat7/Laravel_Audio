@extends('layouts.app')
@section('content')
<div class="table_section padding_infor_info">
    <div class="table-responsive-sm">
       <table class="table table-dark table-striped">
          <thead>
             <tr>
                <th>Title</th>
                <th>Audio File</th>
                <th>Video File</th>
                <th>Edit</th>
                <th>Delete</th>
             </tr>
          </thead>
          <tbody>
            @foreach ($medias as $media)
             <tr>
                <td>{{ $media->title }}</td>
                <td>
                    <audio controls>
                        <source src="{{ asset($media->audio_path) }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                </td>
                <td>
                <video width="400" controls>
                    <source src="{{ asset($media->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video></td>

                {{-- <td>
                    <a href="{{ route('medias.download', ['id' => $media->id, 'type' => 'audio']) }}" class="btn btn-primary">
                        <i class="bi bi-download"></i> Download Audio
                    </a>
                </td>
                <td>

                        <a href="{{ route('medias.download', ['id' => $media->id, 'type' => 'video']) }}" class="btn btn-primary">
                            <i class="bi bi-download"></i> Download Video
                        </a>
                </td> --}}

                <td>
                    <a href="{{ route('medias.edit', $media->id) }}" class="btn btn-info">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </td>

                <td>
                    <form action="{{ route('medias.destroy', $media->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </td>
             </tr>
            @endforeach
          </tbody>
       </table>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


@endsection
