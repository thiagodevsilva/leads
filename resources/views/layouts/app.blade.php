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

                @if(Auth::user()->isAdmin())
                    <div class="row">
                        <div class="mt-2">
                            <span class="display-6">Dashboard</span>                            
                        </div>
                        <div class="text-center d-flex justify-content-center">                            
                            <span>Leads com contatos não realizados.</span>
                            <div class="box-chart">
                                <canvas id="leadsChart"></canvas>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-2">
                    <span class="display-6">Listagem de Leads</span><span>({{ $leads->count() }})</span>
                </div>

                <div class="row mt-2 p-3 filters">
                    <div class="col-md-4">
                        <form action="{{ route('app') }}" method="GET" class="d-inline">
                            <input type="text" name="search" placeholder="Search" value="{{ request()->input('search') }}">
                            <input type="submit" value="Search" class="btn btn-sm btn-primary">
                            <a href="{{ route('app') }}" class="btn btn-sm btn-danger" title="Limpar filtro">&times;</a>
                        </form>
                    </div>
                    <div class="col-md-8 text-end">  
                        <span>
                            <input type="checkbox" id="showRecentFirstCheckbox" onchange="toggleRecentFirst(this)"{{ request()->input('recent_first') === 'true' ? 'checked' : '' }}> Recentes primeiro | 
                        </span>                      
                        <span>
                            <input type="checkbox" id="showOnlyPendingCheckbox" onchange="togglePendingLeads(this)"{{ request()->input('show_only_pending') === 'true' ? 'checked' : '' }}> Apenas pendentes    
                        </span>
                    </div>
                </div>

                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr class="row">
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
                {{ $leads->links('pagination::bootstrap-4', ['class' => 'custom-pagination']) }}
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
        .filters {
            background: #315382;
            border-radius: 7px;
            color: #fff;
        }
        thead tr {
            font-size: 0.9em;
            text-align: center;
        }
        .box-chart {
            width: 100%;
            max-width: 250px;
        }
    </style>

    <script>
        /*
        *   Função para ordenar os leads
        */
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

        /*
        *   Função para ocultar/exibir contatos já realizados
        */
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

        /*
        *   Comportamento do gráfico do dashboard
        */
        var ctx = document.getElementById('leadsChart').getContext('2d');

        console.log({!! json_encode($leadsByUser) !!});
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_column($leadsByUser, 'name')) !!},
                datasets: [{
                    label: 'Leads: ',
                    data: {!! json_encode(array_column($leadsByUser, 'count')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });


    </script>

@endsection