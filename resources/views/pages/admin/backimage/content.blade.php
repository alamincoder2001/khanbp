@extends('layouts.admin-master', ['pageName'=> 'backimage', 'title' => 'Add BackImage'])
@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush    
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    <h4 class="heading"><i class="fa fa-address-card"></i> Update Section & Page Background Image</h4>
                    <form action="{{ route('backimage.update', $backimage) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-2">
                                <div class="form-group my-2 text-center">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage1" style="width: auto;height: 130px;">
                                </div>
                                <label for="bgimage_other" class="">Page's cover (size 1600 * 600)</label>
                                <input style="padding: 1px;" class="form-control form-control-sm" id="bgimage_other" type="file" name="bgimage_other" onchange="readURL1(this);">
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="form-group my-2 text-center">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage2" style="width: auto;height: 130px;">
                                </div>
                                <label for="bgimage_news" class="">Section cover (size 400 * 600)</label>
                                <input style="padding: 1px;" class="form-control form-control-sm" id="bgimage_news" type="file" name="bgimage_news" onchange="readURL2(this);">
                            </div>
                        </div>
                        {{-- <hr class="mt-0"> --}}
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
    document.getElementById("previewImage1").src="{{ asset('/website/assets/image/section-background/'.$backimage->bgimage_other) }}";

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
    document.getElementById("previewImage2").src="{{ asset('/website/assets/image/section-background/'.$backimage->bgimage_news) }}";
</script>
@endpush