@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">All Cusotmers</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Cusotmers</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Cusotmers</h3>
                    <div class="ms-auto">
                        <a href="{{ route('create-customers') }}" class="btn btn-pill btn-primary">Add Cusotmer</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">SL</th>
                                    <th class="wd-15p border-bottom-0">Image</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-20p border-bottom-0">Mobile Number</th>
                                    <th class="wd-15p border-bottom-0">Email</th>
                                    <th class="wd-10p border-bottom-0">Address</th>
                                    <th class="wd-25p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $data  as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><img src="{{  asset($item->image) }}" alt="" width="110" style="border-radius: 20px"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->mobile_no }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            <a href="{{ route('edit-customer', $item->id) }}"
                                                class="btn btn-pill btn-success d-inline-block"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>

                                            <button class="btn btn-pill btn-danger button"> <i class="fa-solid fa-trash-can"></i></button>

                                            <form action="{{ route('delete-customer', $item->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')

                                            </form>
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

            button.on('click', function() {
                let form = $(this).next('form')
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        form.submit()
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })
            })
        </script>
    @endpush
@endsection
