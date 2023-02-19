@extends('layouts.admin-master', ['pageName'=> 'all', 'title' => 'All Orders'])
{{-- @section('title', 'Service') --}}
@section('admin-content')
<main>
    {{-- @php  dd($order) @endphp --}}
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-header">
                <i class="fas fa-list"></i>
                All Orders
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-left">Name</th>
                                <th>Phone</th>
                                <th class="text-left">Address</th>
                                <th class="text-left">Note</th>
                                <th>Invoice Number</th>
                                <th>Status</th>
                                <th class="text-right">Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="text-left">{{ $item->customer->name}}</td>
                                    <td>{{ $item->customer->phone}}</td>
                                    <td class="text-left">{{ $item->customer->address}}</td>
                                    <td class="text-left">{{ $item->customer->note }}</td>
                                    <td>{{ $item->invoice_number }}</td>
                                    <td>
                                        {{-- {{ !isset($item->deleted_at) }} --}}
                                        @if($item->status == 'p' && !isset($item->deleted_at))
                                        <a href="{{ route('pending.state', $item->id) }}" class="btn btn-warning btn-mod-sm text-white">Pending</a>
                                        @elseif($item->status == 'c'&& !isset($item->deleted_at))
                                        <button type="button" class="btn btn-success btn-mod-sm text-white" disabled>Completed</button>
                                        @elseif($item->deleted_at)
                                        <button type="button" class="btn btn-danger btn-mod-sm text-white" disabled>Cancelled</button>
                                        @else
                                        <a href="#!" class="btn btn-secondary btn-mod-sm text-white">No State</a>
                                        @endif
                                    </td>
                                    <td class="text-right">{{ $item->total_taka }}</td>
                                    <td>
                                        @if($item->deleted_at)
                                        <a style="padding-left: 5px" href="{{ route('order.deleted', $item->id) }}" class="d-inline" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash" style="color: red"></i></a>
                                        @else
                                        <a href="{{ route('order-details', $item->id) }}" class="d-inline" target="_blank"><i class="far fa-eye"></i></a>
                                        <a style="padding-left: 5px" href="{{ route('order.deleted', $item->id) }}" class="d-inline" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash" style="color: red"></i></a>
                                        @endif
                                    </td>                          
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Data Not Found</td>
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
