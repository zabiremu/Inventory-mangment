@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Add Invoice</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Invoice</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add Invoice</h3>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="Invoice">Inv No</label>
                                <input type="text" class="form-control" id="Invoice" value="{{ $first }}">
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control" id="date" value="{{ $date }}">
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Category">Category Name</label>
                                <select name="Category" id="category_id" class="form-control">
                                    <option value="1" selected disabled>Choose One</option>
                                    @forelse ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <option value="1">No Category</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="supplier">Product Name</label>
                                <select name="product" id="product" class="form-control">
                                    <option selected disabled>Choose One</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="Stock">Stock(Pc/Kg)</label>
                                <input type="text" class="form-control" id="Stock" value="0">
                            </div>
                        </div>

                        <div class="col-lg-2 mt-1">
                            <div class="form-group">
                                <button class="btn btn-primary-gradient mt-5 addMore"> <i class="fa-solid fa-plus"></i> Add
                                    More</button>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-12">

                    <div class="card-body w-100">
                        <form action="{{ route('store.invoice') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>PCS/KG</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">

                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="4">Discount</td>
                                        <td>
                                            <input type="number" name="Discount" value=""
                                                id="Discount" class="form-control" placeholder="Discount Ammount" value="">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">Grand Total</td>
                                        <td>
                                            <input type="text" name="estimated_ammount" value=""
                                                id="estimated_ammount" class="form-control" placeholder="Total Ammount" readonly>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="form-group">
                                <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Write Description"></textarea>
                            </div>
                            <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="paid_ammount">Paid Status</label>
                                    <select name="paid_ammount" id="paid_ammount" class="form-control">
                                        <option value="fullPaid">Full Paid</option>
                                        <option value="fullDue">Full Due</option>
                                        <option value="partisalPaid">Partial Paid</option>
                                    </select>
                                    <input type="text" placeholder="Enter Paid Ammount" name="partial" class="form-control ppaid mt-3" style="display: none;">
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Category">Customer Name</label>
                                    <select name="customer_id" id="customer_id" class="form-control">
                                        <option value="1" selected disabled>Choose One</option>
                                        @forelse ($customer as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                            <option value="1">No Customer</option>
                                        @endforelse
                                        {{-- <option value="0">New Customer</option> --}}
                                    </select>
                                </div>
                            </div>
                            
                            <div class="new-customer" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name" name="name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="mobile number" name="mobile_no">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

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
       <script class="Invocie-table">
        <tr class="delete">
            <input type="hidden" name='date' value="@{{ date }}"/>
            <input type="hidden" name="invoice_no" value="@{{ invoice_no }}"/>
            <td>
                <input type="hidden" class="form-control category" name="category[]" value="@{{ category }}"/>@{{ cat_name }}
            </td>
            <td>
                <input type="hidden" class="form-control product_id" name="product_id[]" value="@{{ product_id }}"/>@{{ pname }}
            </td>
            <td>
                <input type="number" class="form-control selling_qty" name="selling_qty[]" value=""/>
            </td>
            <td>
                <input type="number" class="form-control unit_price" name="unit_price[]" value=""/>
            </td>
            <td>
                <input type="number" class="form-control selling_price" name="selling_price[]" value="0" readonly/>
            </td>
            <td>
                <button  class = "btn btn-danger mt-5 closeTable" > <i class="fa-solid fa-trash-can"></i> </button> 
            </td>
        </tr>
       </script>

       <script>
            $(document).ready(function(){
                $(document).on('click','.addMore',function(){
                     var date = $('#date').val();
                     var Invoice = $('#Invoice').val();
                     var category_id = $('#category_id').val();
                     var category_name = $('#category_id').find('option:selected').text();
                     var prdouct = $('#product').val();
                     var prdouct_name = $('#product').find('option:selected').text();
                    if(category_id == null){
                        $.notify("Catgory Name Is Required", {  globalPosition: 'top right',
                        className:'error'});
                        return false;
                    }
                    if(prdouct == null){
                        $.notify("Prdouct Name Is Required", {  globalPosition: 'top right',
                        className:'error'});
                    }
                    var source = $('.Invocie-table').html();
                    var template = Handlebars.compile(source);
                    
                    data = {
                        date: date,
                        invoice_no: Invoice,
                        category:category_id,
                        cat_name:category_name,
                        product_id: prdouct,
                        pname:prdouct_name,
                    };

                    var html = template(data);
                    $('#addRow').append(html)
                    
                })

                $(document).on('click','.closeTable',function(){
                    var closeTable = $(this).closest('.delete').remove();
                    totalAmmount()
                })
                $(document).on('keyup','.selling_qty,.unit_price',function(){
                    var qty = $(this).closest('tr').find('input.selling_qty').val();
                    var unit = $(this).closest('tr').find('input.unit_price').val();
                    var total = qty * unit;
                    var result = $(this).closest('tr').find('input.selling_price').val(total);
                    totalAmmount()
                    $('#Discount').trigger('keyup');
                })

                $(document).on('keyup','#Discount',function(){
                    totalAmmount();
                })

                function totalAmmount(){
                    var sum = 0;
                    $('.selling_price').each(function(){
                        var res = $(this).val();
                        if(!isNaN(res) && res.length != 0){
                            sum += parseFloat(res);
                        }
                        var dis = parseFloat($('#Discount').val());
                        if(!isNaN(dis) && dis.length != 0){
                            sum -= parseFloat(dis);
                        }
                       
                    });
                    $('#estimated_ammount').val(sum)
                }

            })
            
       </script>

        <script>
            var Cat = $('#category_id')
            Cat.on('change', function() {
                var id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "/select/invoice/" + id,
                    success: function(data) {
                        var opt = `<option value="">Select Product</option>`;
                        $.each(data,function(key,v){
                            opt += `<option value="${v.id}">${v.name}</option>`;
                        });
                    
                        $('#product').html(opt);
                    },
                })
            })
        </script>

        <script>
            var product = $('#product')
            product.on('change',function(){
                var id = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "/select/product/stock/" + id,
                    success:function(res){
                        $('#Stock').val(res.quantity)
                    },
                })
            }) 
        </script>

        <script>
            $(document).ready(function(){
                $(document).on('change','#paid_ammount',function(){
                    var val = $(this).val();
                    if(val == 'partisalPaid'){
                        $('.ppaid').show();
                    }else{
                        $('ppaid').hide();
                    }
                })
            })

            // $(document).ready(function(){
            //     $(document).on('change','#customer_id',function(){
            //         var val = $(this).val();
            //         if(val == '0'){
            //             $('.new-customer').show();
            //         }else{
            //             $('new-customer').hide();
            //         }
            //     })
            // })
        </script>
    @endpush
@endsection
