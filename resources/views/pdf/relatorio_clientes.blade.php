<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Clientes</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cliente-card {
            border: 1px solid #ccc;
            margin-bottom: 15px;
            padding: 10px;
            break-inside: avoid;
        }

        .cliente-header {
            background-color: #f3f4f6;
            padding: 5px;
            font-weight: bold;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        .section-title {
            font-weight: bold;
            margin-top: 8px;
            color: #555;
            text-transform: uppercase;
            font-size: 10px;
        }

        .info-text {
            color: #333;
            margin-bottom: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #eee;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #fafafa;
        }
    </style>
</head>

<body>
    <h1>Relatório de Clientes e Contatos</h1>
    <p style="text-align: center; font-size: 10px; color: #777;">Gerado em: {{ date('d/m/Y H:i') }}</p>

    @foreach($clientes as $cliente)
        <div class="cliente-card">
            <div class="cliente-header">
                {{ $cliente->nome_completo }} <span style="font-weight: normal; font-size: 10px; float: right;">Registrado
                    em: {{ date('d/m/Y', strtotime($cliente->data_registro)) }}</span>
            </div>

            <table style="margin-bottom: 10px;">
                <tr>
                    <td width="50%" valign="top">
                        <div class="section-title">E-mails</div>
                        @forelse($cliente->emails as $email)
                            <div class="info-text">{{ $email->email }}</div>
                        @empty
                            <div class="info-text" style="color: #999;">-</div>
                        @endforelse
                    </td>
                    <td width="50%" valign="top">
                        <div class="section-title">Telefones</div>
                        @forelse($cliente->telefones as $tel)
                            <div class="info-text">{{ $tel->numero }}</div>
                        @empty
                            <div class="info-text" style="color: #999;">-</div>
                        @endforelse
                    </td>
                </tr>
            </table>

            @if($cliente->contatos->count() > 0)
                <div class="section-title" style="border-bottom: 2px solid #eee; margin-bottom: 5px;">Contatos Vinculados
                    ({{ $cliente->contatos->count() }})</div>
                <table>
                    <thead>
                        <tr>
                            <th width="30%">Nome</th>
                            <th width="35%">E-mails</th>
                            <th width="35%">Telefones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cliente->contatos as $contato)
                            <tr>
                                <td>{{ $contato->nome_completo }}</td>
                                <td>

                                    @foreach($contato->emails as $email)
                                        <div>{{ $email->email }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($contato->telefones as $tel)
                                        <div>{{ $tel->numero }}</div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="font-style: italic; color: #999; font-size: 10px; margin-top: 5px;">Nenhum contato vinculado.</div>
            @endif
        </div>
    @endforeach
</body>

</html>