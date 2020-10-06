<main>
    <div>
        <form action="<?php echo FRONT_ROOT ?>Home/Register" method="POST">
            <div>
                <input type="text" name="name" placeholder="Nombre" required>
            </div>
            <div>
                <input type="text" name="lastname" placeholder="Apellido" required>
            </div>
            <div>
                <input type="text" name="dni" placeholder="DNI" required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div>
                <input type="text" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <button onclick="window.location.href='<?php echo FRONT_ROOT ?>Home/ShowLoginView'">
            Iniciar Sesión con una cuenta existente
        </button>
    </div>
</main>