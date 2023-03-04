<div class="my-3 container mx-5">
    <h1>
        Registro
    </h1>
    <div>
        <form action="register" method="POST" class="mx-5">
            <div class="mt-3">
                <label for="">Nombre:</label>
                <input type="text" class="form-control p-1" name="name" placeholder="Juan">
            </div>
            <div class="mt-3">
                <label for="">Apellido:</label>
                <input type="text" class="form-control p-1" name="lastname" placeholder="Moyano">
            </div>
            <div class="mt-3">
                <label for="">Usuario:</label>
                <input type="text" class="form-control p-1" name="username" placeholder="junito123">
            </div>
            <div class="mt-3">
                <label for="">Correo:</label>
                <input type="text" class="form-control p-1" name="email" placeholder="juanito@correo.com">
            </div>
            <div class="mt-3">
                <label for="">Telefono</label>
                <input type="text" class="form-control p-1" name="phone" placeholder="+756543987">
            </div>
            <div class="mt-3">
                <label for="">Contraseña</label>
                <input type="text" class="form-control p-1" name="password" placeholder="Juan*8">
            </div>
            <div class="d-flex justify-content-center mt-3">
                <input class="btn btn-primary" type="submit" value="Entrar">
                <div class="ml-5">
                    <a href="login"> Ya estoy Registrado</a>
                </div>
            </div>
        </form>
    </div>
</div>