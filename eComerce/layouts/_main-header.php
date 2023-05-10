<header>
    <a href="index.php"><div class="logo-place"><img src="img/super suples.png"></div></a>
    <div class="search-place">
        <input type="text" id="idbusqueda" placeholder="Busca tus suplementos">
        <button class="btn-main btn-search" onclick="search_producto()"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="options-place">
        <?php
        if(isset($_SESSION['codusu'])){
            echo
            '<div class="item-option" onclick="mostrar_opcionese()">
                <i class="fa-solid fa-user" ></i>  
            </div>';
        }else{
        ?>
        <a href="login.php"><div class="item-option" ><i class="fa-solid fa-user"></i></div></a>
        <?php
        }
        ?>
        <a href="carrito.php"><div class="item-option" title="Mis compras"><i class="fa-solid fa-cart-shopping"></i></div></a>
		<div class="item-option" ><i class="fa-solid fa-bars"></i></div>
    </div>
    <div class="menu-movil">
            <div class="item-option" onclick="mostrar_opciones()"><i class="fa-solid fa-bars"></i></div>
        </div>
</header>
<script type="text/javascript">
    function mostrar_opciones(){
        if (document.getElementById("ctrl-menu").style.display=="none") {
			document.getElementById("ctrl-menu").style.display="block";
		}else{
			document.getElementById("ctrl-menu").style.display="none";
		}
    }
</script>
<div class="menu_opciones" id="ctrl-menu" style="display: none;">
<?php
	if (isset($_SESSION['codusu'])) {
	?>
	<ul>
		<li>
			<a href="#">
				<div class="menu-opcion">Mi cuenta</div>
			</a>
		</li>
		<li>
			<a href="carrito.php">
				<div class="menu-opcion">Mi carrito</div>
			</a>
		</li>
		<li>
			<a href="historial.php">
				<div class="menu-opcion">Mis compras</div>
			</a>
		</li>
		<li>
			<a href="pedido.php">
				<div class="menu-opcion">Pedidos pendientes de pago</div>
			</a>
		</li>
		<li>
			<a href="_logout.php">
				<div class="menu-opcion">Cerrar sesión</div>
			</a>
		</li>
	</ul>
	<?php
	}else{
	?>
	<ul>
		<li>
			<a href="login.php">
				<div class="menu-opcion">Iniciar sesión</div>
			</a>
		</li>
        <li>
			<a href="register.php">
				<div class="menu-opcion">Registrarse</div>
			</a>
		</li>
		<li>
			<a href="carrito.php">
				<div class="menu-opcion">Carrito</div>
			</a>
		</li>
	</ul>
	<?php
	}
	?>
</div>

<script type="text/javascript">
    function mostrar_opcionese(){
        if (document.getElementById("ctrl-menue").style.display=="none") {
			document.getElementById("ctrl-menue").style.display="block";
		}else{
			document.getElementById("ctrl-menue").style.display="none";
		}
    }
</script>
<div class="menu_opciones" id="ctrl-menue" style="display: none;">
<?php
	if (isset($_SESSION['codusu'])) {
	?>
	<ul>
		<li>
			<a href="#">
				<div class="menu-opcion">Mi cuenta</div>
			</a>
		</li>
		<li>
			<a href="historial.php">
				<div class="menu-opcion">Mis compras</div>
			</a>
		</li>
		<li>
			<a href="pedido.php">
				<div class="menu-opcion">Pedidos pendientes de pago</div>
			</a>
		</li>
		<li>
			<a href="_logout.php">
				<div class="menu-opcion">Cerrar sesión</div>
			</a>
		</li>
	</ul>
	<?php
	}else{
	?>
	<ul>
		<li>
			<a href="login.php">
				<div class="menu-opcion">Iniciar sesión</div>
			</a>
		</li>
        <li>
			<a href="register.php">
				<div class="menu-opcion">Registrarse</div>
			</a>
		</li>
		<li>
			<a href="carrito.php">
				<div class="menu-opcion">Carrito</div>
			</a>
		</li>
	</ul>
	<?php
	}
	?>
</div>