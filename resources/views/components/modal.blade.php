<tbody>
    @foreach ($leads as $key => $lead)
        <tr class="row" data-bs-toggle="modal" data-bs-target="#leadModal{{ $lead->id }}">
            <td class="col">{{ $lead->name }}</td>
            <td class="col">{{ $lead->email }}</td>
            <td class="col">{{ $lead->telefone }}</td>
            <!-- Adicione mais dados de coluna conforme necessário -->
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
                        <div class="border rounded mx-5 my-3 p-2">
                            Responsavel: {{ $lead->user->name }}
                        </div>
                        <p>Nome: {{ $lead->name }}</p>
                        <p>Email: {{ $lead->email }}</p>
                        <p>Telefone: {{ $lead->telefone }}</p>
                        <p>Endereço: {{ $lead->address->rua }}, {{ $lead->address->numero  }} {{ $lead->address->complemento }}</p>
                        <p>Bairro: {{ $lead->address->bairro }}</p>
                        <p>Cidade: {{ $lead->address->cidade }} - {{ $lead->address->estado }}</p>
                        <!-- Adicione mais dados conforme necessário -->
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</tbody>
