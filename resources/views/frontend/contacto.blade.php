<x-layout>
    <h1 class="container-main px-3" style="text-align:start; font-family: Georgia, Georgia, serif;">Pagina de contacto</h1>
    <div class="container-main px-3">
  <div class="row">
    
    <!-- Columna izquierda -->
    <div class="col-md-4">
      <p style="text-align:start; font-family: 'Trebuchet MS', Helvetica, sans-serif;"><br><br>Este es un mensaje para avisar <br>que me voy a volver loca (mas de lo que ya estoy)</p>
    </div>

    <!-- Columna derecha (formulario) -->
    <div class="col-md-8">
      <form>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label lavel">Correo electrónico</label>
          <input type="email" class="form-control" id="exampleInputEmail1">
          <div class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label lavel">Contraseña</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label lavel" for="exampleCheck1">Check me out</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

  </div>
</div>
</x-layout>