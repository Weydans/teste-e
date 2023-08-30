{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
    <h5 class="col-md-6 text-muted">Fila de Processos</h5>
</div>

<form action="/store" method="POST">

  <div class="form-group row">
    <label for="name" class="col-sm-1 col-form-label"><span class="text-danger">*</span>NOME</label>
    <div class="col-sm-6">
      <select id="name" name="name" class="form-control form-control-sm">
        <option value=""></option>
        {% for actionName, actionEnum in actions %}
        <option value="{{ actionEnum }}" {{ old.name == actionEnum ? 'selected' : '' }} >{{ actionName }}</option>
        {% endfor %}
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="person" class="col-sm-1 col-form-label"><span class="text-danger">*</span>PESSOA</label>
    <div class="col-sm-6">
      <select id="person" name="person" class="form-control form-control-sm">
        <option value="">Selecione uma pessoa</option>
        {% for person in people %}
        <option value="{{ person.id }}" {{ old.person == person.id ? 'selected' : '' }}>{{ person.name }}</option>
        {% endfor %}
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="unit" class="col-sm-1 col-form-label"><span class="text-danger">*</span>UNIDADE</label>
    <div class="col-sm-6">
      <select id="unit" name="unit" class="form-control form-control-sm">
        <option value="">Selecione uma unidade</option>
        {% for unit in unities %}
        <option value="{{ unit.id }}" {{ old.unit == unit.id ? 'selected' : '' }}>{{ unit.name }}</option>
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
        <option value="{{ statusEnum }}" {{ old.status == statusEnum ? 'selected' : '' }}>{{ statusLabel }}</option>
        {% endfor %}
      </select>
    </div>
  </div>

  <div class="col-sm-12 mt-3 p-2" style="background: #ddd;">
      <button type="submit" class="btn btn-sm btn-success mr-2">Gravar</button>
  </div>
</form>

{% endblock %}
