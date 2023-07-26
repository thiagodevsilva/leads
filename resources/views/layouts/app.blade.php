@extends('home.main')

@section('title', 'Home')

@section('content')  
    
    <div>

        <div>
            <div class="mx-5">
                <div class="row mt-2">
                    @php
                        $name = explode(' ', trim(Auth::user()->name));
                        $first_name = $name[0];
                    @endphp
                    <span>Olá, <span style="font-size: 1.25em;">{{ $first_name }}!</span></span>
                </div>

                <div class="mt-2">
                    <span class="display-6">Tabela de Leads</span><span>({{ $leads->count() }})</span>
                </div>

                <div class="row mt-2 p-3" style="background: #315382; border-radius: 7px; color: #fff;">
                    <div class="col-sm-8">
                        <form action="{{ route('app') }}" method="GET" class="d-inline">
                            <input type="text" name="search" placeholder="Search" value="{{ request()->input('search') }}">
                            <input type="submit" value="Search" class="btn btn-sm btn-primary">
                            <a href="{{ route('app') }}" class="btn btn-sm btn-danger" title="Limpar filtro">&times;</a>
                        </form>
                    </div>
                    <div class="col-sm-4 text-end">  
                        <input type="checkbox" id="showRecentFirstCheckbox" onchange="toggleRecentFirst(this)"{{ request()->input('recent_first') === 'true' ? 'checked' : '' }}> Recentes primeiro |                       
                        <input type="checkbox" id="showOnlyPendingCheckbox" onchange="togglePendingLeads(this)"{{ request()->input('show_only_pending') === 'true' ? 'checked' : '' }}> Apenas pendentes    
                    </div>
                </div>

                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr class="row" style="font-size: 0.9em; text-align: center;">
                            <th class="col">Nome</th>
                            <th class="col d-none d-lg-block">Email</th>
                            <th class="col d-none d-sm-block">Telefone</th>
                            <th class="col d-none d-xl-block">Data/Hora</th>
                            <th class="col">Contato realizado</th>
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

    <script>
        function toggleRecentFirst(checkbox) {
            const url = new URL(window.location);
            const searchInput = document.querySelector('input[name="search"]');

            if (checkbox.checked) {
                url.searchParams.set('recent_first', 'true');
            } else {
                url.searchParams.delete('recent_first');
            }

            if (searchInput.value) {
                url.searchParams.set('search', searchInput.value);
            } else {
                url.searchParams.delete('search');
            }

            const showOnlyPendingCheckbox = document.getElementById('showOnlyPendingCheckbox');
            if (showOnlyPendingCheckbox.checked) {
                url.searchParams.set('show_only_pending', 'true');
            } else {
                url.searchParams.delete('show_only_pending');
            }

            window.location.href = url;
        }

        function togglePendingLeads(checkbox) {
            const url = new URL(window.location);
            const searchInput = document.querySelector('input[name="search"]');

            if (checkbox.checked) {
                url.searchParams.set('show_only_pending', 'true');
            } else {
                url.searchParams.delete('show_only_pending');
            }

            if (searchInput.value) {
                url.searchParams.set('search', searchInput.value);
            } else {
                url.searchParams.delete('search');
            }

            const showRecentFirstCheckbox = document.getElementById('showRecentFirstCheckbox');
            if (showRecentFirstCheckbox.checked) {
                url.searchParams.set('recent_first', 'true');
            } else {
                url.searchParams.delete('recent_first');
            }

            window.location.href = url;
        }

    </script>

@endsection