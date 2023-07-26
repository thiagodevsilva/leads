@extends('home.main')

@section('title', 'Home')

@section('content')
    
    <div class="container">
        <div class="row" style="position: relative;">
            <div class="col-md-6" style="display: flex; justify-content: center; align-items: center; padding-top: 100px;">
                <form class="w-100" action="" method="POST">
                    <div class="mb-3 row">
                        <label for="name_lead" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name_lead" name="name_lead">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone_lead" class="col-sm-2 col-form-label">Telefone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="phone_lead" name="phone_lead" placeholder="(12) 99999-0000">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email_lead" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email_lead" name="email_lead" placeholder="email@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Endereço</label>
                        <div class="col-sm-10">
                          <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="cep_lead" name="cep_lead" placeholder="CEP">
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control" id="logr">
                                </div> 
                            </div>                         
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                          <div class="row">
                            <div class="col-sm-4">
                                <input type="text"  class="form-control" id="numero_lead" name="numero_lead" placeholder="Nº">
                            </div>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" id="numero_lead" name="numero_lead" placeholder="Complemento">
                            </div>
                          </div>
                        </div>
                    </div>
                </form>
                {{-- <img src="{{ asset('images/logo.png')}}" alt="Logo" title="EFL Exercises" class="img-fluid"> --}}
            </div>
            <div class="col-md-6" style="padding-top: 140px;">
                <div class="jumbotron text-center" style="color: #315382">
                    <h1 class="display-4">Gerenciador de exercícios.</h1>
                    <p class="lead">Ferramenta EFL Brazil©.</p>
                    <hr class="my-4">
                    <p>Destinado a colaboradores da EFL Brazil©.</p>
                    {{-- <a href="{{ route('site.login') }}" class="btn btn-lg" href="#" role="button" style="background-color: #315382; color: #FFF;">Acessar</a> --}}
                  </div>
            </div>
        </div>
    </div>

@endsection