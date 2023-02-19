@extends('layouts.admin-master', ['pageName'=> 'gallery', 'title' => 'Add Gallery'])
{{-- @section('title', 'gallery') --}}
@push('admin-css')
@endpush
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-area">
                    <h4 class="heading"><i class="fas fa-plus"></i> Add a Photo (Most 10 photos at a time)</h4>
                    <form action="{{ route('store.gallery') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="event1" class="mb-2"> Event Name <span class="text-danger">*</span> </label>
                                <select name="event_id" class="form-control form-control-sm d-inline-block mb-2" id="event1">
                                    <option value="">Select Event</option>
                                    @foreach ($event as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('admin.event') }}" class="add-item add-item2"><i class="fas fa-plus-circle"></i></a>
                                @error('event_id') <span style="color: red">{{$message}}</span> @enderror
                            
                                {{-- <label for="title"> Image Name </span> </label>
                                <input type="text" name="title" class="form-control form-control-sm shadow-none @error('title') is-invalid @enderror" id="title" placeholder="Enter Image Name">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                 --}}
                                <div class="field">
                                    <label for="image">Image <small>(Size: 720px * 480px)</small></label>
                                    <input class="form-control form-control-sm upload__inputfile @error('image') is-invalid @enderror" data-max_length="10" id="image" type="file" name="image[]" multiple>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-2">
                                <img src="" alt="" srcset="">
                            </div> --}}
                        </div>
                        <hr class="my-2">
                        <div class="clearfix mt-1">
                            <div class="float-md-left">
                                <button type="reset" class="btn btn-dark btn-sm">Reset</button>
                                <button type="submit" class="btn btn-info btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-header">
                <i class="fas fa-list"></i>
                Gallery List
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
                           
                            @forelse ($galleries as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->event ? $item->event->name : 'Unknown'}}</td>                               
                                    <td><img class="border" style="height: 26px; width:35px;" src="{{ asset('uploads/gallery/'.$item->image) }}" alt=""></td>
                                    <td>
                                        <a href="{{ url('gallery/edit/'. $item->id) }}" type="submit" class="btn btn-info btn-mod-info btn-sm mr-1"><i class="fas fa-edit"></i></button>
                                        <a href="{{ url('gallery/delete/'.$item->id) }}" type="submit" class="btn btn-danger btn-mod-danger btn-sm" onclick="return confirmDel()"><i class="fas fa-trash"></i></button>
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
            </div>
        </div>
    </div>
</main>
@endsection
@push('admin-js')
<script>
    
$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#image").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#image");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f);
      }
      console.log(files);
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>
@endpush