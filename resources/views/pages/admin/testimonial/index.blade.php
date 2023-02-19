@extends('layouts.admin-master', ['pageName'=> 'testimonial', 'title' => 'Add Testimonial'])
@section('title', 'Testimonial')
@section('admin-content')
    <main>
        <div class="container ">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> >Certification</span>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=""><i class="fab fa-servicestack me-1"></i>&nbsp;Certification</div>
                        </div>
                        <div class="card-body table-card-body">
                            <form  action="{{ route('testimonial.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong><label>Name</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control my-form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
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
                                        <input type="text" id="post" class="form-control my-form-control @error('post') is-invalid @enderror" name="post" value="{{ old('post') }}">
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
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-md-3">
                                        <strong><label>Phone</label> <span class="float-right">:</span></strong>
                                    </div> --}}
                                    {{-- <div class="col-md-9">
                                        <input type="text" id="phone" class="form-control my-form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
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
                                        <input type="text" id="rank" class="form-control my-form-control @error('rank') is-invalid @enderror" name="rank" value="{{ old('rank') }}">
                                        @error('rank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="col-md-3">
                                        <strong><label>Image <small>(Size: 120px * 120px)</small></label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <input type="file" class="form-control my-form-control" id="image" name="image" onchange="readURL(this);">
                                        {{-- <small class="text-danger">(Dimention 120*120 px)</small> --}}
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="height:100px;width:120px; background: #3f4a49;">
                                    </div>

                                    {{-- <div class="col-md-3">
                                        <label><strong>Show Phone</strong></label><span style="float: right">:</span>
                                    </div> --}}
                                    {{-- <div class="col-md-9">
                                        <input type="checkbox" class="" name="is_phone" value="a">
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm mt-2 float-right  mt-3" value="Submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="table-head"><i class="fas fa-table me-1"></i>Our Team<a href=""
                                    class="float-right"><i class="fas fa-print"></i></a></div>
                        </div>
                        <div class="card-body table-card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center bg-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>post</th>
                                        {{-- <th>Phone</th>
                                        <th>Rank</th>
                                        <th>show_Phone</th> --}}
                                        <th>Image</th>
                                        <th width="20%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonial as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->post }}</td>
                                            {{-- <td>{{ $item->phone }}</td>
                                            <td>{{ $item->rank }}</td> --}}
                                            {{-- <td>@if($item->is_phone == 'a') Active @else Inactive @endif</td> --}}
                                            <td class="text-center"><img src="{{ asset($item->image) }}" alt="" class="tbl-image"></td>
                                            <td class="text-center">
                                                <a href="{{ route('testimonial.edit', $item->id) }}"class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('testimonial.destroy', $item->id) }}" class="btn btn-danger btn-sm btn-delete"  onclick="return confirm('Are you sure?')"><i class="far fa-trash-alt"></i></a>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('admin') }}/js/sweetalert2.all.js"></script>
    <script>
        function deleteUser(id) {
            swal({
                title: 'Are you sure?',
                text: "You want to Delete this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
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
        document.getElementById("previewImage").src = "/noimage.png";
    </script>
@endpush
