@extends('layouts.admin-master', ['pageName'=> 'event', 'title' => 'Add Event'])
{{-- @section('title') Add Product Model @endsection --}}
@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($eventData))
                        <i class="fas fa-edit mr-1"></i>Update Event
                        
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Event
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$eventData) ? route('admin.event.update', $eventData->id) : route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="name"> Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" value="{{ @$eventData ? $eventData->name : old('name') }}" class="form-control form-control-sm mb-2" id="name" placeholder="Enter Event Name">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="image"> Image <small>(Size: 720px * 480px)</small> <span class="text-danger">*</span> </label>
                                    <input type="file" name="image" value="{{ @$eventData->image }}" class="form-control form-control-sm mb-2" id="image" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror

                                    <div class="form-group mt-2">
                                        <img class="form-controlo img-thumbnail" src="{{(@$eventData) ? asset($eventData->image) : asset('uploads/no.png') }}" id="mainThmb" style="width: 150px;height: 120px;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    @if(@$eventData)
                                    <a href="{{ route('admin.event') }}" class="btn btn-dark btn-sm">Back</a>
                                    @else
                                    <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                    @endif
                                    <button type="submit" class="btn btn-info btn-sm">{{(@$eventData)? 'Update':'Create'}}</button>
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
                        Event List
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
                                    @foreach ($event as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><img src="{{ $item->image }}" alt="" height="30px" width="30px"></td>
                                        <td>
                                            <a href="{{ route('admin.event.edit', $item->id) }}" class="btn btn-info btn-mod-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.event.delete', $item->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-mod-danger btn-sm"><i class="fas fa-trash"></i></a>
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

