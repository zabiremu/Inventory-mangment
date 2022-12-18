@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Add Product</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add Product</h3>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="purchase">Purchase No</label>
                                <input type="text" class="form-control" id="purchase_no">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="supplier">Supplier Name</label>
                                <select name="supplier" id="supplier" class="form-control select2-show-search form-select"  data-placeholder="Choose one">
                                    <option value="1" selected disabled>Choose One</option>
                                    @forelse ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <option value="1">No Supplier</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="supplier">Category Name</label>
                                <select name="Category" id="Category" class="form-control">
                                    <option value="1" selected disabled>Choose One</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="supplier">Product Name</label>
                                <select name="product" id="product" class="form-control">
                                    <option value="1" selected disabled>Choose One</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-1">
                            <div class="form-group">
                                <button class="btn btn-primary-gradient mt-5 addMore"> <i class="fa-solid fa-plus"></i> Add More</button>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-12">

                    <div class="card-body w-100">
                        <form action="{{ route('add.product') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>PCS/KG</th>
                                        <th>Unit Price</th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">

                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input type="text" name="estimated_ammount" value="0"
                                                id="estimated_ammount" class="form-control" readonly>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="col-lg-4 mt-1">
                                <div class="form-group">
                                    <button class="btn btn-primary-gradient mt-5">Purchase Store</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- Col End-->
    </div>


    @push('script')
        <script class="document" id="document-template">
        <tr class = "delete-item" id = "delete_item" >
                <input type = "hidden" name = "date[]" value = "@{{ date }}" >
                <input type = "hidden" name = "purchase_no[]" value = "@{{ purchase_no }}" >
                <input type = "hidden" name = "supplier[]" value = "@{{ supplier }}" >
                
            <td> <input type = "hidden"  name = "Category[]"  value = "@{{ Category }}" > @{{ category_name }} </td> 
            
            <td> <input type = "hidden"  name = "product[]" value = "@{{ product }}" > @{{ product_name }} </td> 
            <td> <input type = "number" min = "1" class = "form-control buying_qty" name = "buying_qty[]" value = "" >
            </td> 
            <td> <input type = "number"  class = "form-control unit_price"  name = "unit_price[]" value = "" >
            </td> 
            <td> <input type = "text" class = "form-control description" name = "description[]" > </td> 
            <td>
            <input type = "number"  class = "form-control buying_price text-right" name = "buying_price[]" value = "0"
            readonly >
            </td> 
            <td> <button  class = "btn btn-danger mt-5 closeTable" > <i class="fa-solid fa-trash-can"></i> </button> </td > 
        </tr>
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '.addMore', function() {
                    var date = $('#date').val();
                    var purchase_no = $('#purchase_no').val();
                    var supplier_id = $('#supplier').val();
                    var Category = $('#Category').val();
                    var CategoryName = $('#Category').find('option:selected').text();
                    var product_id = $('#product').val();
                    var product_name = $('#product').find('option:selected').text();
                    console.log(Category,CategoryName,product_id,product_name,supplier_id)
                    if (date == '') {
                        $.notify("Date is required", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                        return false;
                    }
                    if (purchase_no == '') {
                        $.notify("Purchase No is required", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                        return false;
                    }
                    if (purchase_no == '') {
                        $.notify("Purchase No is required", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                        return false;
                    }
                    if (supplier_id == '') {
                        $.notify("Supplier Id No is required", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                        return false;
                    }
                    if (Category == '') {
                        $.notify("Category Id No is required", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                        return false;
                    }
                    if (product_id == '') {
                        $.notify("Product Id No is required", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                        return false;
                    }

                    var source = $('#document-template').html();
                    var template = Handlebars.compile(source);

                    data = {
                        date: date,
                        purchase_no: purchase_no,
                        supplier: supplier_id,
                        Category: Category,
                        category_name: CategoryName,
                        product: product_id,
                        product_name: product_name,
                    };
                    var html = template(data);
                    $('#addRow').append(html)
                })

                $(document).on('click','.closeTable',function(){
                    $(this).closest('#delete_item').remove();
                    totatAmmount();
                });
                $(document).on('keyup','.buying_qty ,.unit_price',function(){
                    var qty = $(this).closest('tr').find('input.buying_qty').val();
                    var unit = $(this).closest('tr').find('input.unit_price').val();
                    var total = qty * unit;
                    var result = $(this).closest('tr').find('input.buying_price').val(total);
                    totatAmmount();
                });
                function totatAmmount(){
                    var sum = 0;
                    $('.buying_price').each(function(){
                        var value = $(this).val();
                        if(!isNaN(value) && value.length != 0){
                            sum += parseFloat(value);
                        }
                    });
                    console.log(sum);
                    $('#estimated_ammount').val(sum)
                }
            })
        </script>
        <script>
            let supplier = $('#supplier')
            let Category = $('#Category')
            supplier.on('change', function() {
                let value = $(this).val();
                $.ajax({
                    method: "GET",
                    url: '/select/supplier/' + value,
                    success: function(data) {
                        if (data.noCategory != "No Category") {
                            var option = `<option value="">Select Category</option>`;
                            $.each(data, function(key, v) {
                                option +=
                                    `<option value="${v.category_id}">${v.category.name}</option>`;
                            });
                            Category.html(option);
                        } else {
                            var option = `<option value="1">${data.noCategory}</option>`;
                            Category.html(option);
                        }
                    },
                })
            })
        </script>
        <script>
            let category = $('#Category');
            category.on('click', function() {
                let supplier = $('#supplier')
                let id = supplier.val();
                let value = $(this).val();
                $.ajax({
                    method: "GET",
                    url: '/select/products/' + value,
                    data: {
                        supplier: id,
                    },
                    success: function(res) {
                        if (res.noProduct != "No Product") {
                            let html = `<option value="">Select Product</option>`;
                            $.each(res, function(key, v) {
                                html += `<option value="${v.id}">${v.name}</option>`
                            })
                            $('#product').html(html);
                        } else {
                            let html = `<option value="">${res.noProduct}</option>`;
                            $('#product').html(html);
                        }
                    },
                })
            })
        </script>
    @endpush
@endsection
