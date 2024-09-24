@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4 text-white">Create Media and Audio</h6>
                    <form method="POST" action="{{ route('medias.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Title" name="title" required>
                            <label for="title">Title</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" placeholder="image" name="image" >
                            <label for="iamges">Image</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control"  name="audio" >
                            <label for="audio">Audio File</label>
                        </div>
                         <!-- Video File Field -->
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" placeholder="Video file" name="video" >
                            <label for="video">Video File</label>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-success" type="submit">Upload Media and Audio</button>
                        </div>
                    </form>
                </div>
            </div>
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
@endsection
