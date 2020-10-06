<main>
    <div>
        <form action="<?php echo FRONT_ROOT ?>Home/Login" method="POST">
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Ingresar Email" required>
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="text" name="password" placeholder="Ingresar constraseña" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <button onclick="window.location.href='<?php echo FRONT_ROOT ?>Home/ShowRegistrationView'">Registrarse</button>
    </div>
</main>