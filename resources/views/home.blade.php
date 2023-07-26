@extends('home.main')

@section('title', 'Contato - Leads')

@section('content')  
    
    <div class="container">
        <div class="row" style="position: relative;">
            <div class="col-xl-6 box-leads">
                @if (session('successo'))
                <div>
                    <div>
                        <span>Contato solicitado com sucesso!</span>
                    </div>
                    <div class="box-btn-voltar">
                        <a href="{{ route('home') }}" class="btn btn-sm">Voltar</a>
                    </div>

                </div>
                @else
                <form class="w-100" action="{{ route('add.lead')}}" method="POST">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name_lead" class="col-sm-2 col-form-label text-end">Nome</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="nome_lead" name="nome" value="{{ old('nome') }}">
                          <span class="span-errors">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone_lead" class="col-sm-2 col-form-label text-end">Telefone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="telefone_lead" name="telefone" placeholder="(12) 99999-0000" value="{{ old('telefone') }}">
                          <span class="span-errors">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email_lead" class="col-sm-2 col-form-label text-end">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control form-control-sm" id="email_lead" name="email" placeholder="email@example.com" value="{{ old('email') }}">
                          <span class="span-errors">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-end">Endereço</label>
                        <div class="col-sm-10">
                          <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="cep_lead" name="cep" placeholder="CEP" value="{{ old('cep') }}">
                                    <span class="span-errors">{{ $errors->has('cep') ? $errors->first('cep') : '' }}</span>
                                </div>                                
                            </div>                         
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">  
                            <input type="text" readonly class="form-control form-control-sm" id="logr" name="logr" style="font-size: 0.9em;">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                          <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" id="numero_lead" name="numero" placeholder="Nº" value="{{ old('numero') }}">
                                <span class="span-errors">{{ $errors->has('numero') ? $errors->first('numero') : '' }}</span>
                            </div>
                            <div class="col-8">
                                <input type="text"  class="form-control form-control-sm" id="complemento_lead" name="complemento" placeholder="Complemento" value="{{ old('complemento') }}">
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="hidden" id="rua" name="rua">
                            <input type="hidden" id="estado" name="estado">
                            <input type="hidden" id="cidade" name="cidade">
                            <input type="hidden" id="bairro" name="bairro">
                            <button type="submit" class="btn btn-sm w-100 btn-confirm">Confirmar</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
            <div class="col-xl-6" style="padding-top: 140px;">
                <div class="jumbotron text-center" style="color: #315382">
                    <h1 class="display-5">Cadastre-se agora</h1>
                    <hr class="my-2 mx-5">
                    <p>Após envio do formulário um corretor entrará em contato em instantes!</p>
                  </div>
            </div>
        </div>
    </div>

    <style>
        .box-leads {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px;
        }
        .btn-confirm {
            background: #315382;
            color: #FFF;
            font-size: 1.15em;
        }
        .box-btn-voltar {
            text-align: center;
            margin-top: 14px;
        }
        .box-btn-voltar a{
            background: #315382;
            color: #FFF;
        }
        .span-errors {
            font-size: 0.9em;
            color: #ff000070;
        }
    </style>

    <script>
        // busca cep
        document.getElementById('cep_lead').addEventListener('blur', function() {
            var cep = this.value;
            if (cep != '') {
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(function(response) {
                        if (!response.ok) {
                            throw new Error('CEP não encontrado');
                        }
                        return response.json();
                    })
                    .then(function(data) {
                        document.getElementById('logr').value = data.logradouro + ', ' + data.bairro + ', ' + data.localidade + ' - ' + data.uf;
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    })
                    .catch(function(error) {
                        console.error(error.message);
                    });
            }
        });

        // mascaras para o telefone e o cep
        $('#cep_lead').mask('00000-000');
        $('#telefone_lead').mask('(00) 0000-00009');
        $('#telefone_lead').blur(function(event) {
            if($(this).val().length == 15){
                $('#telefone_lead').mask('(00) 00000-0009');
            } else {
                $('#telefone_lead').mask('(00) 0000-00009');
            }
        });
    </script>

@endsection