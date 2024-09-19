
<form action="{{ route('audios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="audio">Audio File:</label>
    <input type="file" name="audio" required>

    <button type="submit">Upload</button>
</form>
