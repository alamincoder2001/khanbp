@extends('layouts.admin-master', ['pageName'=> 'category', 'title' => 'Add Category'])
{{-- @section('title') Add Category @endsection --}}
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($categoryData))
                        <i class="fas fa-edit mr-1"></i>Update Category
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Category
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$categoryData) ? route('admin.category.update', $categoryData->id) : route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name"> Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" value="{{ @$categoryData ? $categoryData->name : old('name')}}" class="form-control form-control-sm mb-2" id="name" placeholder="Enter Category name">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="image"> Image <span style="font-size: 12px; font-weight: 400">(200px * 200px)</span></label>
                                    <input type="file" name="image" value="{{ @$categoryData->image }}" class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group mt-2">
                                        <img class="form-controlo img-thumbnail" src="{{(@$categoryData) ? asset($categoryData->image) : asset('uploads/no.png') }}" id="mainThmb" style="width: 150px;height: 120px;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-info btn-sm">{{(@$categoryData)?'Update':'Create'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                        Category List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        @if($item->image)
                                        <td><img src="{{ asset($item->image) }}" alt="" style="height: 60px; width: 60px"></td>
                                        @else
                                        <td><img src="{{ asset('uploads/no.png') }}" alt="" style="height: 60px; width: 60px"></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.category.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.category.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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
