@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">All Pending Purchase</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Pending Purchase</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Pending Purchase</h3>
                    <div class="ms-auto">
                        <a href="{{ route('add.Purchase') }}" class="btn btn-pill btn-primary"> <i class="fa-solid fa-plus"></i> Add Purchase</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">SL</th>
                                    <th class="wd-10p border-bottom-0">Purchase No</th>
                                    <th class="wd-15p border-bottom-0">Date</th>
                                    <th class="wd-20p border-bottom-0">Supplier</th>
                                    <th class="wd-15p border-bottom-0">Category</th>
                                    <th class="wd-15p border-bottom-0">Qty</th>
                                    <th class="wd-15p border-bottom-0">Product Name</th>
                                    <th class="wd-15p border-bottom-0">Status</th>
                                    <th class="wd-25p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->purchase_no }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date))   }}</td>
                                        <td>{{ $item->supplier->name }}</td>
                                        <td>{{ $item->category->name  }}</td>
                                        <td>{{ $item->buying_qty }}</td>
                                        <td>{{ $item->product->name  }}</td>
                                        <td>@if($item->status == 0) 
                                            <button class="btn btn-warning">Pending</button>
                                            @else
                                            <button class="btn btn-success">Approve</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 0)
                                            <button class="btn btn-pill btn-danger button"><i class="fa-solid fa-check"></i></button>

                                            <form action="{{ route('approve', $item->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf

                                            </form>
                                            @endif
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
    <!-- End Row -->

    @push('script')
    <script>
        let button = $('.button')
        button.click(function() {
            let form = $(this).next('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Approved!',
                        'Your file has been Approved.',
                        'success'
                    )
                    form.submit();
                }
            })
        })
    </script>
    @endpush
@endsection
