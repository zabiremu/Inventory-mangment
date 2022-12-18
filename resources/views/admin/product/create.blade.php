@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Add Products</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Products</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add Products</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('store-products') }}" method="post">
                        @csrf
                        <div class="d-flex flex-column">

                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your Unit Name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Supplier</label>
                                <select class="form-control select2 form-select select2-hidden-accessible"
                                    data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="Supplier" required>
                                    <option label="Choose one"></option>
                                    @forelse ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <option value="">No Supplier</option>
                                    @endforelse
                                </select><span
                                    class="select2 select2-container select2-container--default select2-container--below select2-container--focus"
                                    dir="ltr" style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-dnm2-container"><span
                                                class="select2-selection__rendered" id="select2-dnm2-container"><span
                                                    class="select2-selection__placeholder">Choose one</span></span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Unit</label>
                                <select class="form-control select2 form-select select2-hidden-accessible"
                                    data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="Unit" required>
                                    <option label="Choose one"></option>
                                    @forelse ($Unit as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <option value="">No Supplier</option>
                                    @endforelse
                                </select><span
                                    class="select2 select2-container select2-container--default select2-container--below select2-container--focus"
                                    dir="ltr" style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-dnm2-container"><span
                                                class="select2-selection__rendered" id="select2-dnm2-container"><span
                                                    class="select2-selection__placeholder">Choose one</span></span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control select2 form-select select2-hidden-accessible"
                                    data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="Category" required>
                                    <option label="Choose one"></option>
                                    @forelse ($Category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <option value="">No Supplier</option>
                                    @endforelse
                                </select><span
                                    class="select2 select2-container select2-container--default select2-container--below select2-container--focus"
                                    dir="ltr" style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-dnm2-container"><span
                                                class="select2-selection__rendered" id="select2-dnm2-container"><span
                                                    class="select2-selection__placeholder">Choose one</span></span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                            <button class="btn ripple btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Col End-->
    </div>
@endsection
