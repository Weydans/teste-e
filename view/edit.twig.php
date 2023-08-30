{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
    <h5 class="col-md-6 text-muted">Fila de Processos</h5>
    {% if process.integrated == false %}
    <form action="/integrate/{{ process.id }}" method="POST">
        <button type="submit" class="btn btn-sm btn-success">
          Integrar com volkLMS
        </button>
    </form>
    {% endif %}
</div>

<form action="/update/{{ process.id }}" method="POST">

  <div class="form-group row">
    <label for="name" class="col-sm-1 col-form-label"><span class="text-danger">*</span>NOME</label>
    <div class="col-sm-6">
      <select id="name" name="name" readonly class="form-control form-control-sm">

      {% for actionName, actionEnum in actions %}
        {% if process.type == actionEnum %}
          <option value="{{ actionEnum }}">
            {{ actionName }}
          </option>
        {% endif %}
      {% endfor %}

      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="person" class="col-sm-1 col-form-label"><span class="text-danger">*</span>PESSOA</label>
    <div class="col-sm-6">
      <select id="person" name="person" readonly class="form-control form-control-sm">

      {% for person in people %}
        {% if process.person.id == person.id %}
          <option value="{{ person.id }}">
            {{ person.name }}
          </option>
        {% endif %}
      {% endfor %}

      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="unit" class="col-sm-1 col-form-label"><span class="text-danger">*</span>UNIDADE</label>
    <div class="col-sm-6">
      <select id="unit" name="unit" readonly class="form-control form-control-sm">

      {% for unit in unities %}
        {% if process.unit.id == unit.id %}
          <option value="{{ unit.id }}">
            {{ unit.name }}
          </option>
        {% endif %}
      {% endfor %}

      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="status" class="col-sm-1 col-form-label"><span class="text-danger">*</span>UNIDADE</label>
    <div class="col-sm-6">
      <select id="status" name="status" class="form-control form-control-sm">
        <option value="">Selecione o status</option>

        {% for statusLabel, statusEnum in statusList %}
          <option value="{{ statusEnum }}" {{ old.status == statusEnum or process.status == statusEnum ? 'selected' : '' }}>
            {{ statusLabel }}
          </option>
        {% endfor %}

      </select>
    </div>
  </div>

  <div class="col-sm-12 mt-3 p-2" style="background: #ddd;">
      <button type="submit" class="btn btn-sm btn-success mr-2">Gravar</button>
      <a href="/create" class="btn btn-sm btn-primary">Novo</a>
  </div>
</form>

{% endblock %}
