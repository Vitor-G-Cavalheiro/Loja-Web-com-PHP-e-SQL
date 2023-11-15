<div class="menu-store">
    <a class="menu-store-link <?=$tema?>" href="">Notícias</a>
    <?php if($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"):?>
    <a class="menu-store-link <?=$tema?>" href="../user/favoritesGames.php">Lista de Desejos</a>
    <a class="menu-store-link <?=$tema?>" href="../store/cartGames.php">Carrinho</a>
    <?php endif;?>
    <form action="../store/listGames.php" method="post">
        <input type="text" name="pesquisa" placeholder="Buscar Jogo" required>
        <button type="submit"><img class="search-logo" src="../../imgs/search.png"></button>
    </form>
</div>