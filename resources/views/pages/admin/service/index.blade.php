@extends('layouts.admin-master', ['pageName'=> 'speciality', 'title' => 'Add Speciality'])
{{-- @section('title', 'Service') --}}

@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-plus"></i>
                        Add Company Speciality (At most 3 specialities)
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.service') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="mb-1"> Title <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" class="form-control form-control-sm shadow-none @error('name') is-invalid @enderror" id="name" placeholder="Enter a Title" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    {{-- <label for="description" class="mb-1">Description</label>
                                    <textarea name="description" class="form-control form-control-sm" id="description" rows="3"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <label for="s_description" class="mb-1">Short Description</label>
                                    <textarea name="s_description" class="form-control form-control-sm @error('s_description') is-invalid @enderror" id="s_description" rows="3" placeholder="Enter a short description">{{ old('s_description') }}</textarea>
                                    @error('s_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="image">Image <span style="font-size: 12px; font-weight: 400">(Size: 440px * 360px)</label>
                                    <input class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" type="file" name="image" onchange="readImgURL(this);">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-group mt-2" style="margin-bottom: 0">
                                        <img class="img-thumbnail" src="#" id="previewImage" style="width: 160px;height: 120px;">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-info btn-sm">{{(@$subcategoryData)?'Update':'Create'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-2">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list"></i>
                        Speciality List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if($item->image)
                                                <img src="{{ $item->image }}" alt="" style="width: 30px; height: 26px ";>
                                                @else 
                                                No Data Found
                                                @endif
                                            </td>                    
                                            {{-- <td>
                                                @if($item->s_description)
                                                {!! Str::words($item->s_description, 2, '...') !!}
                                                @else
                                                No Data Found
                                                @endif
                                            </td>                                     --}}
                                            <td>
                                                <a href="{{ route('edit.service', $item->id) }}" type="submit" class="btn btn-info btn-mod-info btn-sm mr-1"><i class="fas fa-edit"></i></button>
                                                <a href="{{ route('delete.service', $item->id) }}" type="submit" class="btn btn-danger btn-mod-danger btn-sm" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
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
        height: 120,
        placeholder: 'Enter a Long Description'
    });
</script>
<script>
    function readImgURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(120)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage").src="/uploads/no.png";

</script>
@endpush
