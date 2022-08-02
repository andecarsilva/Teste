@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text">
                            {{ Session::get('status') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Clientes</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal"><i class="fas fa-plus"></i> Novo Cliente</a>
                                <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#searchModal"><i class="fas fa-search"></i> Pesquisar Cliente</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">ID</th>
                                    <th scope="col" class="sort" data-sort="budget">Nome</th>
                                    <th scope="col" class="sort" data-sort="status">CPF</th>
                                    <th scope="col">Cliente Válido?</th>
                                    <th scope="col" class="sort" data-sort="completion">Data De Nascimento</th>
                                    <th scope="col" class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($customers as $customer)
                                    <tr>

                                        <td class="budget">
                                            {{ $customer->id }}
                                        </td>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder"
                                                        src="{{ asset('assets') }}/users/{{ $customer->profile_picture }}">
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $customer->name }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            {{ $customer->cpf }}
                                        </td>
                                        <td>
                                            @if ($customer->status_cliente)
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-success"></i>
                                                    <span class="status">Sim</span>
                                                </span>
                                            @else
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-danger"></i>
                                                    <span class="status">Não</span>
                                                </span>
                                            @endif


                                        </td>
                                        <td>
                                            {{ $customer->birth_date }}
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                        href="edit_view_customer/{{ $customer->id }}">Editar</a>
                                                </div>
                                            </div>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('create_customers') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="name" class="form-control" placeholder="Nome"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control datepicker"name="birth_date"
                                            placeholder="Data De Nascimento" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="rg" class="form-control" placeholder="RG"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="cpf" class="form-control {{ $errors->has('email') ? ' has-danger' : '' }}" placeholder="CPF"
                                            required />
                                    </div>
                                    @if ($errors->has('cpf'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="zip_code" class="form-control" placeholder="CEP"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="address" class="form-control"
                                            placeholder="Logradouro" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="number" class="form-control" placeholder="Numero"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="district" class="form-control" placeholder="Bairro"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="public_place" class="form-control"
                                            placeholder="Municipio" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="county" class="form-control" placeholder="UF"
                                            required />
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
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('search_customer') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Pesquisar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="name_search" class="form-control" placeholder="Nome" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-4">

                                        <input type="text" name="cpf_search" class="form-control" placeholder="CPF" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>

                </form>

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
