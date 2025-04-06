@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-wrapper p-4 rounded shadow-sm">
        <!-- Success Message -->
        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        <!-- Upload Completion Form -->
        <div style="text-align: left; margin-top: 20px;">
            <h3>Upload Completion Form</h3>
            <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Choose image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Upload Image</button>
            </form>
        </div>

        <div style="margin-top: 30px;">
            <h3>Uploaded Files</h3>
            @if(count($files) > 0)
                <ul>
                    @foreach($files as $file)
                        <li>
                            <img src="{{ Storage::url($file) }}" width="100" alt="Uploaded Image"> 
                            <a href="{{ Storage::url($file) }}" target="_blank">View</a>
                            <form action="{{ route('rename.image', ['file' => basename($file)]) }}" method="POST">
                                @csrf
                                <input type="text" name="new_name" placeholder="Enter new name" class="form-control" style="width: 200px;">
                                <button type="submit" class="btn btn-warning btn-sm">Rename</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No files uploaded yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
