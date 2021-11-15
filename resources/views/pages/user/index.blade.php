@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/data-tables/data-tables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/data-tables/responsive/css/responsive.dataTables.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('List User') }}
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary text-white float-right">
                            <i class="fas fa-plus"></i> Add User
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-sm dataTable">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Action</th>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>NIK</th>
                                        <th>Full Name</th>
                                        <th>Role</th>
                                        <th>Phone</th>
                                        <th>Service Center</th>
                                        <th>Mobile Access</th>
                                        <th>Email</th>
                                        <th>ERP ID</th>
                                        <th>Created At</th>
                                        <th>Active</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/data-tables/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/data-tables/data-tables/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/data-tables/responsive/js/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            @if(session()->has('message'))
            alert("{{ session()->get('message') }}");
            @endif

            $('.dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{route('user.index')}}",
                "columns": [
                    {
                        "data": 'action',
                        "name": 'action',
                        "orderable": false,
                        "searchable": false
                    },
                    {
                        "data": "id"
                    },
                    {
                        "data": "username"
                    },
                    {
                        "data": "nik"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "role.role_name"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "organization.organization"
                    },
                    {
                        "data": "is_access_mobile"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "erp_user_id"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "is_active"
                    },
                    {
                        "data": null,
                        "defaultContent": ""
                    },
                ],
                "responsive": {
                    "details": {
                        "type": 'column',
                        "target": -1
                    }
                },
                "columnDefs": [
                    {
                        "className": 'control',
                        "orderable": false,
                        "searchable": false,
                        "targets": -1
                    },
                    {
                        width: "100px",
                    },
                    {
                        orderable: false,
                    }
                ],
            });
        });
    </script>
@endsection
