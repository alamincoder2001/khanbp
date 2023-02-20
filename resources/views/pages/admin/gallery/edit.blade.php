@extends('layouts.admin-master', ['pageName'=> 'gallery', 'title' => 'Edit Gallery'])
{{-- @section('title', 'gallery') --}}
@push('admin-css')
@endpush
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="form-area">
                    <h4 class="heading"><i class="fas fa-edit"></i> Edit Photo</h4>
                    <form action="{{ route('update.gallery', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="event1" class="mb-2"> Event Name <span class="text-danger">*</span> </label>
                                <select name="event_id" class="form-control form-control-sm d-inline-block mb-2" id="event1">
                                    <option value="">Select Event</option>
                                    @foreach ($event as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $gallery->event_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('admin.event') }}" class="add-item add-item2"><i class="fas fa-plus-circle"></i></a>
                                @error('event_id') <span style="color: red">{{$message}}</span> @enderror
                            </div>
                            {{-- <div class="col-md-12 mb-2">
                                <label for="title"> Image Name <span class="text-danger">*</span> </label>
                                <input type="text" name="title" class="form-control form-control-sm shadow-none @error('title') is-invalid @enderror" id="title" placeholder="Enter Image Name" value="{{ $gallery->title }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                        <div class="col-md-12 mb-2">
                            <label for="image">Image (Size: 720px * 480px)</label>
                            <input class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" type="file" name="image" onchange="readURL(this);">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group mt-2">
                                <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="width: 100px;height: 80px; background: #3f4a49;">
                            </div>
                        </div>
                </div>
                <div class="clearfix border-top">
                    <div class="float-md-right mt-2">
                        <button type="button" id="prev" class="btn btn-dark btn-sm">Prev</button>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection
@push('admin-js')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(80);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    @if(isset($gallery->image))
    document.getElementById("previewImage").src = "/uploads/gallery/{{ $gallery->image }}";
    @else
    document.getElementById("previewImage").src = "/uploads/no.png";
    @endif

    document.getElementById("prev").onclick = function() {
        location.href = "{{ route('galleries') }}";
    };
</script>
@endpush