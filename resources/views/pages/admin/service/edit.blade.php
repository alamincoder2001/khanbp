@extends('layouts.admin-master', ['pageName'=> 'speciality', 'title' => 'Edit Speciality'])
{{-- @section('title', 'Update Service') --}}
@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    <h4 class="heading"><i class="fas fa-edit"></i> Edit Speciality</h4>
                    <form action="{{ route('update.service', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="mb-1"> Title <span class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control form-control-sm shadow-none @error('name') is-invalid @enderror" id="name" placeholder="Enter Service Name" value="{{ $service->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                <label for="s_description" class="mb-1">Short Description</label>
                                <textarea name="s_description" class="form-control form-control-sm @error('s_description') is-invalid @enderror" id="s_description" rows="3">{{ $service->s_description }}</textarea>
                                @error('s_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                               
                            </div>

                            <div class="col-md-6 mb-2">

                                <label for="image">Image  <span style="font-size: 12px; font-weight: 400">(Size: 440px * 360px)</label>
                                <input class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" type="file" name="image" onchange="readImgURL(this);">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                                <div class="form-group mt-2" style="margin-bottom: 0">
                                    <img class="img-thumbnail" src="#" id="previewImage" style="width: 160px;height: 130px;">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix border-top">
                            <div class="float-md-right mt-2">
                                <a href="{{ route('service') }}" class="btn btn-dark btn-sm">Prev</a>
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
<script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
<script>
    $('#description').summernote({
        tabsize: 2,
        height: 120
    });

    function readImgURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage").src="{{ asset($service->image) }}";
</script>
@endpush
