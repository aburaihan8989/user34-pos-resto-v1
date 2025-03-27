@extends('layouts.app')

@section('title', 'Customers')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customers</h1>
                <div class="section-header-button">
                    @if ( auth()->user()->roles == "admin" )
                        <a href="{{ route('customer.create') }}" class="btn btn-primary">Add New</a>
                    @else
                        <a href="#" class="btn btn-secondary">Add New</a>
                    @endif
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customers</a></div>
                    <div class="breadcrumb-item">All Customers</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Customers</h2>
                <p class="section-lead">
                    You can manage all Customers, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Customers</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div> --}}
                                <div class="float-right">
                                    <form method="GET" action="{{ route('customer.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Name" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Total Price</th>
                                            <th>Total Bayar</th>
                                            <th>Sisa Tagihan</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration + $customers->firstItem() - 1 }}
                                                </td>
                                                <td>
                                                    {{ $customer->name }}
                                                </td>
                                                <td>
                                                    {{ $customer->phone }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format(($customer->total_price), 0, ",", ".") }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format(($customer->total_bayar), 0, ",", ".") }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format(($customer->total_price-$customer->total_bayar), 0, ",", ".") }}
                                                </td>
                                                <td>
                                                    {{ $customer->created_at }}
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if ( auth()->user()->roles == "admin" )
                                                            <a href='{{ route('customer.edit', $customer->id) }}'
                                                                class="btn btn-sm btn-primary btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                                Edit
                                                            </a>
                                                        @else
                                                            <a href='#'
                                                                class="btn btn-sm btn-secondary btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                                Edit
                                                            </a>
                                                        @endif

                                                        @if ( auth()->user()->roles == "admin" )
                                                            <form action="{{ route('customer.destroy', $customer->id) }}"
                                                                method="POST" class="ml-2">
                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete ml-2">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                        @else
                                                            <a href='#'
                                                                class="btn btn-sm btn-secondary btn-icon ml-2">
                                                                <i class="fas fa-times"></i>
                                                                Delete
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $customers->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
