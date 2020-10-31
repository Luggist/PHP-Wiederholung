<?php require_once __DIR__ . "/../../parts/header.php"; ?>

<h1>Produkte</h1>

<?php foreach (product::instance()->getAllProducts() as $idx => $product) { ?>

    <section id="product-<?php echo $idx++;; ?>">
        <img src="<?php echo $product['image']; ?>">
        <div>
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <span><?php echo number_format($product['price'], 2, ',', '.'); ?></span>
            
            <form method="post" action="/cart">
                <input name="add_product" type="hidden" value="<?php echo $idx; ?>">
                <button type="submit">Zum Warenkorb hinzufügen</button>
            </form>
            <form method="post" action="/wishlist" style="padding-top:10px">
                <input name="add_product" type="hidden" value="<?php echo $idx; ?>">
                <button type="submit" >Zur Wunschliste hinzufügen</button>
            </form>
            
        </div>
    </section>
<?php } ?>
<?php require_once __DIR__ . "/../../parts/footer.php"; ?>