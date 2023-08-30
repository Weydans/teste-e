{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
    <h5 class="col-md-6 text-muted">Fila de Processos</h5>
    <a href="/create">
        <button class="btn btn-sm btn-success">Novo Processo</button>
    </a>
</div>

<table class="table table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Pessoa</th>
            <th>Unidade</th>
            <th>Status</th>
            <th>Data Criação</th>
            <th>Data Modificação</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>

    {% for process in processes %}    
        <tr>
            <td>{{ process.id }}</td>

            <td>
            {% for actionLabel, actionValue in actions %}
              {{ process.type == actionValue ? actionLabel : '' }}
            {% endfor %}
            </td>

            <td>{{ process.person.name }}</td>
            <td>{{ process.unit.name }}</td>

            <td>
            {% for statusLabel, statusValue in statusList %}
              {{ process.status == statusValue ? statusLabel : '' }}
            {% endfor %}
            </td>

            <td>{{ process.created_at|date('Y-m-d H:i:s') }}</td>
            <td>{{ process.updated_at|date('Y-m-d H:i:s') }}</td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="/{{ process.id }}" class="btn btn-sm btn-success mr-2">
                        Editar
                    </a>
                    <form action="/delete/{{ process.id }}" method="POST">
                        <button type="submit" class="btn btn-sm btn-danger">
                            Remover
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    {% else %}
        <tr>
            <td colspan="8" class="py-4"><p class="text-center">Nenhum registro encontrado!</p></td>
        </tr>
    {% endfor %}

    </tbody>
    <tfoot>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Pessoa</th>
            <th>Unidade</th>
            <th>Status</th>
            <th>Data Criação</th>
            <th>Data Modificação</th>
            <th>Opções</th>
        </tr>
    </tfoot>
</table>

{% endblock %}
