@extends('layouts.admin-master', ['pageName' => 'faq'])
{{-- @section('title', 'Service') --}}
@section('admin-content')
    <main>
        <div class="container ">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> >FAQ Edit</span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=""><i class="fas fa-question-circle"></i>&nbsp;Edit FAQ</div>
                        </div>
                        <div class="card-body table-card-body">
                            <form action="{{ route('faq.update', $faq->id) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong><label>Title</label> <span class="float-right">:</span></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control my-form-control @error('name') is-invalid @enderror" name="name" value="{{ $faq->name }}">
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
                                        <textarea type="text" id="details" class="form-control my-form-control @error('details') is-invalid @enderror" name="details" value="{{ old('details') }}" cols="7" rows="5">{{ $faq->details }}</textarea>
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
                                            value="Submit">Update</button>
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
@push('admin-js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush
