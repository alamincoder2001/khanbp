@extends('layouts.admin-master', ['pageName'=> 'factory', 'title' => 'Add Content'])  
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    <h4 class="heading"><i class="fa fa-plus"></i> Factory Information</h4>
                    <form action="{{ route('update.factory', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="image1" class="">Image 1 <small>(Size: 354px * 224px)</small></label>
                                <input class="form-control form-control-sm" id="image1" type="file" name="image1" onchange="readURL1(this);">
                                <div class="form-group my-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage1" style="width: 160px;height: 130px;">
                                </div>
                                @error('image1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="image2" class="">Image 2 <small>(Size: 354px * 224px)</small></label>
                                <input class="form-control form-control-sm" id="image2" type="file" name="image2" onchange="readURL2(this);">
                                <div class="form-group my-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage2" style="width: 160px;height: 130px;">
                                </div>
                                @error('image2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="image3" class="">Image 3 <small>(Size: 354px * 224px)</small></label>
                                <input class="form-control form-control-sm" id="image3" type="file" name="image3" onchange="readURL3(this);">
                                <div class="form-group my-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage3" style="width: 160px;height: 130px;">
                                </div>
                                @error('image3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="image4" class="">Image 4 <small>(Size: 354px * 224px)</small></label>
                                <input class="form-control form-control-sm" id="image4" type="file" name="image4" onchange="readURL4(this);">
                                <div class="form-group my-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage4" style="width: 160px;height: 130px;">
                                </div>
                                @error('image4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 offset-md-3 mb-2">
                                <div class="form-group">
                                    <label for="title">Factory Point (maximum 6 points)</label>
                                    <input type="text" name="title" class="form-control form-control-sm mb-2 shadow-none @error('title') is-invalid @enderror" id="title" placeholder="Factory Point" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="clearfix mt-1">
                            <div class="float-md-right">
                                <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                <button type="submit" class="btn btn-info btn-sm">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                        Factory Points
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Point</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($factoryPoint as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if(Str::of($item->title)->wordCount() > 10)
                                                {!! Str::words($item->title, 10, '...') !!}
                                                @else
                                                {{ $item->title }}
                                                @endif
                                            </td>                    
                                            <td>
                                                <a href="{{ route('edit.factorypoint', $item->id) }}" class="btn-sm btn btn-info"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('delete.factorypoint', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn-sm btn btn-danger"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('admin-js')
<script>
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage1')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage1").src="{{ $factory->image1 }}";


    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage2')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage2").src="{{ $factory->image2 }}";


    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage3')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage3").src="{{ $factory->image3 }}";

    function readURL4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage4')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(130);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage4").src="{{ $factory->image4 }}";
</script>
@endpush