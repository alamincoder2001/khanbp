@extends('layouts.admin-master', ['pageName'=> 'factory', 'title' => 'Add Factory Point'])
{{-- @section('title') Add Category @endsection --}}
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-edit mr-1"></i>Update Factory Point
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.factorypoint', $factorypoint->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title"> Title </label>
                                    <input type="text" name="title" value="{{ $factorypoint->title }}" class="form-control form-control-sm mb-2" id="title" placeholder="Enter factory title">
                                    @error('title') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-info btn-sm">Update</button>
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

