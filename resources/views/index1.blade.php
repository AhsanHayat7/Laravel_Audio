

<a href="{{ route('audios.create') }}">Upload New Audio</a>

<ul>
    @foreach ($audios as $audio)
        <li>
            <strong>{{ $audio->title }}</strong>
            <audio controls>
                <source src="{{ asset($audio->file_path) }}" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
            <a href="{{ route('audios.download', $audio->id) }}">Download</a>
            <a href="{{ route('audios.edit', $audio->id) }}">Edit</a>

            <form action="{{ route('audios.destroy', $audio->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
