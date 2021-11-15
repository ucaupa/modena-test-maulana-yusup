@extends('layouts.app')

@section('styles')
    {{--<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">--}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('User Information') }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-2 text-center">
                                    <img
                                        src="{{asset('images/fox.jpg')}}"
                                        class="rounded-circle border"
                                        alt="..."
                                        id="previewImg"
                                        style="width: 150px; height: 150px;">
                                    <label class="custom-file-upload btn btn-primary text-white mt-3">
                                        <input type="file"
                                               name="photo"
                                               accept="image/*"
                                               onchange="previewFile(this);">
                                        Upload
                                    </label>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputUsername">
                                                    Username <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('username') is-invalid @enderror"
                                                       value="{{ old('username') }}" id="inputUsername"
                                                       name="username" required>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputNIK">
                                                    NIK <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('nik') is-invalid @enderror"
                                                       value="{{ old('nik') }}" id="inputNIK"
                                                       name="nik" required>
                                                @error('nik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName">
                                                    Full Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       value="{{ old('name') }}" id="inputName"
                                                       name="name" required>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">
                                                    Email <span class="text-danger">*</span>
                                                </label>
                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       value="{{ old('email') }}" id="email"
                                                       name="email" required aria-describedby="emailHelp">
                                                <small id="emailHelp" class="form-text text-muted">
                                                    We'll never share your email with anyone else.
                                                </small>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPhone">
                                                    Phone <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       value="{{ old('phone') }}" id="inputPhone"
                                                       name="phone" required>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBankName">
                                                    Bank Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('bank_name') is-invalid @enderror"
                                                       value="{{ old('bank_name') }}" id="inputBankName"
                                                       name="bank_name" required>
                                                @error('bank_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBankAccount">
                                                    Bank Account <span class="text-danger">*</span>
                                                </label>
                                                <input type="number"
                                                       class="form-control @error('bank_account') is-invalid @enderror"
                                                       value="{{ old('bank_account') }}" id="inputBankAccount"
                                                       name="bank_account" required>
                                                @error('bank_account')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('has_npwp') is-invalid @enderror"
                                                       id="inputNpwp"
                                                       name="has_npwp">
                                                <label class="custom-control-label mb-0" for="inputNpwp">
                                                    Has NPWP
                                                </label>
                                                @error('has_npwp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-5">
                                                <label for="inputPostalCode">
                                                    Postal Code
                                                </label>
                                                <input type="number"
                                                       class="form-control @error('postal_code') is-invalid @enderror"
                                                       value="{{ old('postal_code') }}" id="inputPostalCode"
                                                       name="postal_code">
                                                @error('postal_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSubDistrict">
                                                    Sub District
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('sub_district') is-invalid @enderror"
                                                       value="{{ old('sub_district') }}" id="inputSubDistrict"
                                                       name="sub_district">
                                                @error('sub_district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDistrict">
                                                    District
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('district') is-invalid @enderror"
                                                       value="{{ old('district') }}" id="inputDistrict"
                                                       name="district">
                                                @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCity">
                                                    City
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       value="{{ old('city') }}" id="inputCity"
                                                       name="city">
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProvince">
                                                    Province
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('province') is-invalid @enderror"
                                                       value="{{ old('province') }}" id="inputProvince"
                                                       name="province">
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress">
                                                    Address
                                                </label>
                                                <textarea class="form-control @error('address') is-invalid @enderror"
                                                          id="inputAddress" name="address"
                                                          rows="3">{{ old('address') }}</textarea>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputOrganization">
                                                    Organization <span class="text-danger">*</span>
                                                </label>
                                                <select
                                                    class="form-control @error('organization') is-invalid @enderror select2"
                                                    value="{{ old('organization') }}" name="organization"
                                                    id="inputOrganization" required>
                                                    @foreach($organization as $item)
                                                        <option value="{{$item->id}}">{{$item->organization}}</option>
                                                    @endforeach
                                                </select>
                                                @error('organization')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRole">
                                                    Role <span class="text-danger">*</span>
                                                </label>
                                                <select
                                                    class="form-control @error('role') is-invalid @enderror select2"
                                                    name="role"
                                                    id="inputRole" required>
                                                    @foreach($role as $item)
                                                        <option value="{{$item->key}}">{{$item->role_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword">
                                                    Password <span class="text-danger">*</span>
                                                </label>
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       value="{{ old('password') }}" id="inputPassword"
                                                       name="password" required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRePassword">
                                                    Re-Type Password <span class="text-danger">*</span>
                                                </label>
                                                <input type="password"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       value="{{ old('password_confirmation') }}" id="inputRePassword"
                                                       name="password_confirmation" required>
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('active') is-invalid @enderror"
                                                       id="inputActive"
                                                       checked
                                                       name="active">
                                                <label class="custom-control-label mb-0" for="inputActive">
                                                    Active
                                                </label>
                                                @error('active')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('cti_usage') is-invalid @enderror"
                                                       id="inputCtiUsage"
                                                       name="cti_usage">
                                                <label class="custom-control-label mb-0" for="inputCtiUsage">
                                                    CTI Usage
                                                </label>
                                                @error('cti_usage')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="row col-12">
                                                <hr class="col-12">
                                            </div>

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('mobile_login') is-invalid @enderror"
                                                       id="inputMobileLogin"
                                                       name="mobile_login">
                                                <label class="custom-control-label mb-0" for="inputMobileLogin">
                                                    Mobile Login
                                                </label>
                                                @error('mobile_login')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                       class="custom-control-input @error('tmm') is-invalid @enderror"
                                                       id="inputTMM"
                                                       name="tmm">
                                                <label class="custom-control-label mb-0" for="inputTMM">
                                                    TMM
                                                </label>
                                                @error('tmm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputLimitDay">
                                                    Limit Days
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('limit_day') is-invalid @enderror"
                                                       value="{{ old('limit_day') }}" id="inputLimitDay"
                                                       name="limit_day">
                                                @error('limit_day')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputLimitAmount">
                                                    Limit Amount
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('limit_amount') is-invalid @enderror"
                                                       value="{{ old('limit_amount') }}" id="inputLimitAmount"
                                                       name="limit_amount">
                                                @error('limit_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputWarehouse">
                                                    Warehouse Request
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('warehouse_request') is-invalid @enderror"
                                                       value="{{ old('warehouse_request') }}" id="inputWarehouse"
                                                       name="warehouse_request">
                                                @error('warehouse_request')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputErpUser">
                                                    ERP User ID
                                                </label>
                                                <input type="text"
                                                       class="form-control @error('erp_user') is-invalid @enderror"
                                                       value="{{ old('erp_user') }}" id="inputErpUser"
                                                       name="erp_user">
                                                @error('erp_user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary text-white float-right">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--<script src="{{asset('plugins/select2/dist/js/select2.min.js')}}"></script>--}}
    <script>
        $(document).ready(function () {
            // $(".select2").select2({});

            $("#inputPostalCode").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('geolocation') }}",
                        dataType: "json",
                        data: {
                            q: request.term
                        },
                        success: function (data) {
                            response($.map(data, function (item) {
                                return {
                                    label: item.kd_pos + ' - ' + item.kelurahan,
                                    value: item.kd_pos,
                                    data: item
                                };
                            }));
                        }
                    });
                },
                minLength: 4,
                select: function (event, ui) {
                    console.log(ui);
                    $('#inputSubDistrict').val(ui.item.data.kelurahan);
                    $('#inputDistrict').val(ui.item.data.kecamatan.kecamatan);
                    $('#inputCity').val(ui.item.data.kecamatan.kabkot.kabupaten_kota);
                    $('#inputProvince').val(ui.item.data.kecamatan.kabkot.provinsi.provinsi);
                },
                open: function () {
                    $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
                },
                close: function () {
                    $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
                }
            });
        });

        function previewFile(input) {
            let file = $('input[type=file]').get(0).files[0];
            let img = $('#previewImg');
            if (file) {
                // $(img).removeClass('d-none');

                let reader = new FileReader();

                reader.onload = function () {
                    $(img).attr('src', reader.result);
                };

                reader.readAsDataURL(file);
            } else {
                $(img).attr('src', "{{asset('images/fox.jpg')}}");
                // $(img).addClass('d-none');
            }
        }
    </script>
@endsection
