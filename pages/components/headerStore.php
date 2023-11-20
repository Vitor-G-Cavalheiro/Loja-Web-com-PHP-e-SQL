<div class="menu-store back-<?=$tema?>">
    <a class="text-color-<?=$tema?> menu-store-link <?=$tema?>" href="">Notícias</a>
    <?php if($_SESSION["user"] == "usuario" || $_SESSION["user"] == "admin"):?>
    <a class="text-color-<?=$tema?> menu-store-link <?=$tema?>" href="../user/favoritesGames.php">Lista de Desejos</a>
    <a class="text-color-<?=$tema?> menu-store-link <?=$tema?>" href="../store/cartGames.php">Carrinho</a>
    <?php endif;?>
    <form action="../store/listGames.php" method="post">
        <input class="back-emphasys-<?=$tema?> text-color-<?=$tema?>" type="text" name="pesquisa" placeholder="Buscar Jogo" required>
        <button class="back-search-<?=$tema?>"type="submit"><img class="text-color-<?=$tema?> search-logo" src="../../imgs/search.png"></button>
    </form>
</div>