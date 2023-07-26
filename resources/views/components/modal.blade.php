<tbody>
    @foreach ($leads as $key => $lead)
        <tr class="row" style="text-align: center;">
            <td class="col" data-bs-toggle="modal" data-bs-target="#leadModal{{ $lead->id }}">{{ $lead->name }}</td>
            <td class="col d-none d-lg-block" style="word-wrap: break-word; word-break: break-all;" data-bs-toggle="modal" data-bs-target="#leadModal{{ $lead->id }}">{{ $lead->email }}</td>
            <td class="col d-none d-sm-block" data-bs-toggle="modal" data-bs-target="#leadModal{{ $lead->id }}">{{ $lead->telefone }}</td>
            <td class="col d-none d-xl-block" data-bs-toggle="modal" data-bs-target="#leadModal{{ $lead->id }}">{{ date('H:i:s d/m/Y', strtotime($lead->created_at)) }}</td>            
            <td class="col">
                <input class="form-check-input" type="checkbox" onclick="event.stopPropagation();" onchange="markAsContacted(event, {{ $lead->id }}, this)" {{ $lead->contacted_pending ? '' : 'checked' }}>
            </td>  
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="leadModal{{ $lead->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="border rounded mx-5 my-3 p-2 text-center">
                            Responsavel: {{ $lead->user->name }}
                        </div>
                        <p>Nome: {{ $lead->name }}</p>
                        <p>Email: {{ $lead->email }}</p>
                        <p>Telefone: {{ $lead->telefone }}</p>
                        <p>Endereço: {{ $lead->address->rua }}, {{ $lead->address->numero  }} {{ $lead->address->complemento }}</p>
                        <p>Bairro: {{ $lead->address->bairro }}</p>
                        <p>Cidade: {{ $lead->address->cidade }} - {{ $lead->address->estado }}</p>
                        <div class="border rounded mx-5 my-3 p-2 text-center">
                            Solicitado em: {{ date('H:i:s d/m/Y', strtotime($lead->created_at)) }}
                        </div>
                        @if ($lead->contacted_when)
                        <div class="border rounded mx-5 my-3 p-2 text-center">
                            Contactado em: {{ date('H:i:s d/m/Y', strtotime($lead->contacted_when)) }}
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</tbody>

<script>
    /*
    *   Chama a rota responsavel por marcar um lead como contato realizado ou contato não realizado
    */
    function markAsContacted(event, id, checkbox) {        
        fetch('/lead/contacted/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(() => {
            location.reload();
        })
        .catch((error) => {
            console.error('Error:', error);
        });

    }
</script>
