<header id = "ignore">
        <div class="icons">
        <a href="index.php"><img src="assets/icons/logo.png" alt="" class="logo"></a>
        <img src="assets/icons/menu.png" alt="" class="menu-icon" onclick="sb_open()">
        </div>
        <nav id="sidebar">
            <ul class="links">
                <img src="assets/icons/menu.png" alt="" class="menu-icon" onclick="sb_close()">
                <li><a href="partes.php">Partes</a></li>
                <?php
                session_start();
                if (array_key_exists("id", $_SESSION))
                    echo '<li><a href="cuenta-guardadas.php">Builds</a></li>
                    <li><a href="cuenta-index.php">Cuenta</a></li>
                    <li><a href="cuenta-builds.php">Mis Builds</a></li>';
                else
                    echo '<li><a href="login.php">Builds</a></li>
                    <li><a href="login.php">Cuenta</a></li>
                    <li><a href="login.php">Mis Builds</a></li>';
                ?>
                
            </ul>
        </nav>
        
        <input id=search type="search" placeholder="Buscar Partes">
       
        <div class="account">
            <?php
                    if (array_key_exists("id", $_SESSION))
                        echo '<p style= "color: white; font-weight: 600;">Bienvenido, '.$_SESSION["username"].'&emsp;</p>';
                    else {
                        echo '<a href="registrarse.php"><button class="register">Registrarse</button></a>
                        <a href="login.php"><button class="login">Iniciar Sesión</button></a>';
                    }
            ?>
            
        </div>
    </header>
    <script src="sidebar.js"></script>