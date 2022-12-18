@extends('admin.layouts.app')

@section('content')
    @php
        $payment = App\Models\Payment::with('customer')
            ->where('invoice_id', $data->id)
            ->first();
    @endphp
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Invoice Approve</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice Approve</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title me-3">Invoice No: #{{ $data->invoice_no }}</h3>
                    <h3 class="card-title"> Invoice Date: {{ $data->date }}</h3>
                    <div class="ms-auto">
                        <a href="{{ route('add.invoice') }}" class="btn btn-pill btn-primary"> <i
                                class="fa-solid fa-plus"></i> Pending Invoice List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <tr>
                                <td>Customer Info</td>
                                <td>Name: {{ $payment->customer->name }}</td>
                                <td>Mobile No: {{ $payment->customer->mobile_no }}</td>
                                <td>Email: {{ $payment->customer->email }}</td>
                            </tr>
                            <tr>
                                <td>
                                <td colspan="3">Description : {{ $payment->description }}</td>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <form action="{{ route('done',$data->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                <tr>
                                    <td>SL</td>
                                    <td>Category</td>
                                    <td>Product Name </td>
                                    <td>Current Stock </td>
                                    <td>Quantity</td>
                                    <td>Unit Price </td>
                                    <td>Total Price</td>
                                </tr>
                                @php
                                    $sum = 0;
                                @endphp
                                @foreach ($invoiceDetail as $key => $data)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $data->category->name }}</td>
                                        <td>{{ $data->product->name }} </td>
                                        <td>{{ $data->product->quantity }} </td>
                                        <td>{{ $data->selling_qty }}</td>
                                        <td>{{ $data->unit_price }}</td>
                                        <td>{{ $data->selling_price }}</td>
                                    </tr>
                                    @php
                                        $sum += $data->selling_price;
                                    @endphp
                                @endforeach

                                <tr>
                                    <td colspan="6">Total</td>
                                    <td>{{ $sum }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Discount</td>
                                    <td>{{ $payment->discount_ammount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Due</td>
                                    <td>{{ $payment->due_ammount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Paid Ammount</td>
                                    <td>{{ $payment->paid_ammount }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-primary">Approve Purchase</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </form>
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
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        form.submit();
                    }
                })
            })
        </script>
    @endpush
@endsection
