<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - <?php echo $title ?? 'Página'; ?></title>
    <link rel="stylesheet" href="/public/css/style.css"> <!-- Link para o CSS principal -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Início</a></li>
                <li><a href="/menu">Cardápio</a></li>
                <li><a href="/order">Pedidos</a></li>
                <li><a href="/cart">Carrinho</a></li>
                <li><a href="/call-waiter">Chamar Garçom</a></li>
                <li><a href="/checkout">Finalizar Pedido</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Conteúdo específico de cada página -->
        <?php echo $content ?? ''; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Restaurante - Todos os direitos reservados.</p>
    </footer>

    <!-- JavaScript (se necessário) -->
    <script src="/public/js/main.js"></script>
</body>
</html>
