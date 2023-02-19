@extends('layouts.admin-master', ['pageName'=> 'product', 'title' => 'Add Product'])

{{-- @section('title') Add Product @endsection --}}

@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush

@section('admin-content')


<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($productData))
                        <i class="fas fa-edit mr-1"></i>Update Product
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Product
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$productData) ? route('admin.product.update', $productData->id) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="old_image" value="{{ @$productData->image }}">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="category1" class="mb-2"> Category <span class="text-danger">*</span> </label>
                                    <select name="category_id" class="form-control form-control-sm d-inline-block mb-2" id="category1">
                                        <option value="">Select Category</option>
                                        @foreach ($category as $item)
                                            @if (old('category_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}" {{ $item->id == @$productData->category_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <a href="{{ route('admin.categories') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                    @error('category_id') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="name" class="mb-2"> Product Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" value="{{ @$productData ? $productData->name : old('name')}}" class="form-control form-control-sm mb-2" id="name" placeholder="Enter Product name">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="description" class="mb-2"> Product Description <span class="text-danger">*</span> </label>
                                    <textarea name="description" id="description" rows="4" class="form-control">{{ @$productData? $productData->description : old('description') }}</textarea>
                                    @error('description') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="model1" class="mb-2"> Model <span class="text-danger">*</span> </label>
                                    <select name="model_id" class="form-control form-control-sm d-inline-block mb-2" id="model1">
                                        <option value="">Select Model</option>
                                        @foreach ($model as $item)
                                            @if (old('model_id') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                            <option value="{{ $item->id }}" {{ $item->id == @$productData->model_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <a href="{{ route('admin.model') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                    @error('model_id') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="unit1" class="mb-2"> Product Unit <span class="text-danger">*</span> </label>
                                    <select name="unit_id" class="form-control form-control-sm d-inline-block mb-2" id="unit1">
                                        <option value="">Select Unit</option>
                                        @foreach ($unit as $item)
                                            @if (old('unit_id') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                            <option value="{{ $item->id }}" {{ $item->id == @$productData->unit_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <a href="{{ route('admin.unit') }}" class="add-item"><i class="fas fa-plus-circle"></i></a>
                                    @error('unit_id') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="rate" class="mb-2"> Product Rate <span class="text-danger">*</span> </label>
                                    <input type="number" name="rate" value="{{ @$productData ? $productData->rate : old('rate') }}" class="form-control form-control-sm mb-2" id="rate" placeholder="Enter Product Rate">
                                    @error('rate') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="image" class="mb-2">Product Image <span style="font-size: 12px; font-weight: 400">(Size: 720px * 720px)</label>
                                    <input class="form-control form-control-sm" id="image" type="file" name="image" onchange="mainThambUrl(this)">
                                    <div class="form-group mt-2">
                                        <img class="form-controlo img-thumbnail" src="{{(@$productData) ? asset($productData->image) : asset('uploads/no.png') }}" id="mainThmb" style="width: 150px;height: 120px;">
                                    </div>
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-sm btn-dark">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-info">{{(@$productData)?'Update':'Create'}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                        Product List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Model</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Rate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ @$item->model->name? $item->model->name : 'Unknown' }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><img src="{{ asset($item->image) }}" width="30" height="30" alt=""></td>
                                        <td>{{ $item->rate }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', $item->id) }}" class="btn-sm btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.product.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn-sm btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
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
<script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
<script>
    $('#description').summernote({
        tabsize: 2,
        height: 120
    });
</script>

<script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(150)
                  .height(120);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>

@endpush
