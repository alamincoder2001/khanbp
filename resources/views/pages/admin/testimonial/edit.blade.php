@extends('layouts.admin-master', ['pageName'=> 'testimonial', 'title' => 'Add Testimonial'])
{{-- @section('title', 'Edit Testimonial') --}}
@section('admin-content')
    <main>
        <div class="container ">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Certification</span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=""><i class="fab fa-servicestack me-1"></i>Edit Certification</div>
                        </div>
                        <div class="card-body table-card-body">
                            <form action="{{ route('testimonial.update',$testimonial->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong><label>Name</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control my-form-control @error('name') is-invalid @enderror" name="name" value="{{ $testimonial->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <strong><label>Post</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="post" class="form-control my-form-control @error('post') is-invalid @enderror" name="post" value="{{ $testimonial->post }}">
                                        @error('post')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="col-md-3">
                                        <strong><label>Description</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ $testimonial->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-md-3">
                                        <strong><label>Phone</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="phone" class="form-control my-form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $testimonial->phone }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="col-md-3">
                                        <strong><label>Rank Id</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="rank" class="form-control my-form-control @error('rank') is-invalid @enderror" name="rank" value="{{ $testimonial->rank }}">
                                        @error('rank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-3">
                                        <strong><label>Image</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <input type="file" class="form-control my-form-control" id="image" name="image" onchange="readURL(this);">
                                        <small class="text-danger">(Dimention 120*120 px)</small>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="height:100px;width:120px; background: #3f4a49;">
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <label><strong>Show Phone</strong></label><span style="float: right">:</span>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="checkbox" class="" name="is_phone" value="a" {{ $testimonial->is_phone == 'a' ? 'checked' : '' }}>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-secondary mr-2">Back</a>
                                        <button type="submit" class="btn btn-primary btn-sm" value="Update">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('admin-js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage')
                        .attr('src', e.target.result)
                        .width(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById("previewImage").src = "{{ asset($testimonial->image) }}";
    </script>
@endpush
