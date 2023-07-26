@extends('home.main')

@section('title', 'Home')

@section('content')  
    
    <div class="container">
        <div class="row mt-2">
            @php
            $name = explode(' ', trim(Auth::user()->name));
            $first_name = $name[0];
        @endphp
        <span>Olá, <span style="font-size: 1.25em;">{{ $first_name }}!</span></span>
        </div>
        <div>
            <div class="p-5">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="row">
                            <th class="col">Nome</th>
                            <th class="col">Email</th>
                            <th class="col">Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @component('components.modal', ['leads' => $leads])
                        @endcomponent

                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>



    <style>
        td {
            cursor: pointer;
        }
        .table-hover tbody tr:hover {
            background-color: #31538250 !important;
            color: #FFF;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #31538215;
        }
    </style>

@endsection