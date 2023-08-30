<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
          crossorigin="anonymous">

    <style>
      * { font-size: 0.99em !important; }
    </style>

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="p-4 text-white bg-secondary">
      <div class="px-4 d-flex">
        <a href="/" class="text-white" style="font-size: 1.2em !important">Sistema <b>Escudo</b></a>
      </div>
    </nav>
    <div class="navbar navbar-expand-md navbar-dark col-12 py-1" style="background: #f40;">
        <ul class="navbar-nav">
          <li class="nav-item px-4"><a class="nav-link" href="/">Listagem</a></li>
          <li class="nav-item px-4"><a class="nav-link" href="/create">Cadastro</a></li>
        </ul>
    </div>
    
    <div id="content" class="px-5 my-5 pb-5">
      {% if errorMessage %}
        <div class="alert alert-danger">{{ errorMessage }}</div>
      {% endif %}

      {% if successMessage %}
        <div class="alert alert-success">{{ successMessage }}</div>
      {% endif %}

      {% block content %}{% endblock %}
    </div> 
    
    <footer class="p-3 mt-5 bg-secondary text-white text-center">
      <span>Desenvolvido por Weydans Barros</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
            crossorigin="anonymous">
    </script>

  </body>
</html>
