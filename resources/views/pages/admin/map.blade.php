@extends('layouts.admin-master', ['pageName'=> 'map', 'title' => 'Edit Map'])
 
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-area">
                    <h4 class="heading"><i class="fa fa-plus"></i> Update Map</h4>
                    <form action="{{ route('map.update', $map) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="link"> Map <span class="text-danger">*</span> </label>
                                    <input class="form-control form-control-sm @error('link') is-invalid @enderror" id="link" type="url" name="link" value="{{ $map->link }}">
                                </div>
                                @error('link')
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
            <div class="col-md-6">
                <div class="form-area">
                    <h4 class="heading"><i class="fas fa-map-marker-alt"></i> Map View</h4>
                    <div class="map map d-flex justify-content-center">
                        <iframe src="{{ $map->link }}" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
