@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Cliente</h3>
                            </div>

                            <form method="POST" action="{{ route('update_customers') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $customer->name }}" placeholder="Nome" required />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $customer->id }}">

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control datepicker"name="birth_date"
                                                    placeholder="Data De Nascimento" value="{{ $customer->birth_date }}"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="rg" value="{{ $customer->rg }}"
                                                    class="form-control" placeholder="RG" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="cpf" value="{{ $customer->cpf }}"
                                                    class="form-control" placeholder="CPF" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="zip_code"value="{{ $customer->zip_code }}"
                                                    class="form-control" placeholder="CEP" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="address" class="form-control"
                                                    placeholder="Logradouro" value="{{ $customer->address }}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="number" value="{{ $customer->number }}"
                                                    class="form-control" placeholder="Numero" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="district" value="{{ $customer->district }}"
                                                    class="form-control" placeholder="Bairro" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="public_place"
                                                    value="{{ $customer->public_place }}" class="form-control"
                                                    placeholder="Municipio" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group mb-4">

                                                <input type="text" name="county" value="{{ $customer->county }}"
                                                    class="form-control" placeholder="UF" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group mb-4">
                                                <input type="file" name="profile_picture" class="form-control"
                                                    placeholder="Foto De Perfil">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-left: 1%">Alterar</button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("input[name=zip_code]").blur(function() {
                let cep = $(this)
                    .val()
                    .replace(/[^0-9]/, "");
                if (cep) {
                    let url = "https://viacep.com.br/ws/" + cep + "/json/";
                    $.ajax({
                        url: url,
                        dataType: "jsonp",
                        crossDomain: true,
                        contentType: "application/json",
                        success: function(json) {
                            if (json.logradouro) {
                                $("input[name=zip_code]").val(json.cep);
                                $("input[name=address]").val(json.logradouro);
                                $("input[name=district]").val(json.bairro);
                                $("input[name=public_place]").val(json.localidade);
                                $("input[name=county]").val(json.uf);
                            }
                        },
                    });
                }
            });
        })
    </script>
@endpush
