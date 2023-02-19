@extends('layouts.admin-master', ['pageName'=> 'faq', 'title' => 'FAQ'])
{{-- @section('title', 'FAQ Entry') --}}
@section('admin-content')
    <main>
        <div class="container ">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > FAQ</span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class=""><i class="fas fa-plus"></i>&nbsp;Add FAQ</div>
                        </div>
                        <div class="card-body table-card-body">
                            <form action="{{ route('faq.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong><label>Title</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control my-form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <strong><label>Details</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea type="text" id="details" class="form-control my-form-control @error('details') is-invalid @enderror" name="details" cols="7" rows="5">{{ old('details') }}</textarea>
                                        @error('details')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm mt-2 float-right  mt-3"
                                            value="Submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="table-head"><i class="fas fa-list mr-2"></i>FAQ List </div>
                        </div>
                        <div class="card-body table-card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center bg-light">
                                    <tr>
                                        <th>Title Name</th>
                                        <th>Details</th>
                                        <th width="20%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faq as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">{{ Str::words($item->details, 10,'...') }}</td>
                                            <td class="text-center">

                                                <a href="{{ route('faq.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                                {{-- <button type="submit" class="btn btn-delete"
                                                    onclick="deleteUser({{ $item->id }})"><i
                                                        class="far fa-trash-alt"></i></button> --}}
                                                {{-- <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('faq.destroy', $item->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> --}}
                                                <a href="{{ route('faq.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                                    class="far fa-trash-alt"></i></a>
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
@endpush
