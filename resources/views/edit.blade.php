

<form action="{{ route('audios.update', $audio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ $audio->title }}" required>

    <label for="audio">New Audio File (optional):</label>
    <input type="file" name="audio">

    <button type="submit">Update</button>
</form>
