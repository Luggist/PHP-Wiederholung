<?php require_once __DIR__ . "/../../parts/header.php"; ?>

<h1>Wunschliste</h1>

<?php if (Wishlist::instance()->countProductsWishlist() > 0) { ?>

<table>
    <thead>
        <tr>
            <th>Produkt</th>
            <th>Menge</th>
            <th class="right">Preis</th>
            <th class="right">Hinzufügen</th>
            <th class="right">Löschen</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach (Wishlist::instance()->getProductsWishlist() as $product) { ?>

        < <tr>
            <td>
                <?php echo $product['name']; ?>
            </td>
            <td>
                <?php echo $product['quantity'] ?>
            </td>
        
            <td class="right">
                <?php echo number_format($product['price'], 2, ",", "."); ?>
            </td>
            <td class="right" >
                <form  action="/wishlist"  method="post">
                <input name="add_product_cart" type="hidden" value="<?php echo $product['id']; ?>">
                <button type="submit"><img class="icon" src="icons/addProduct.svg"></button>
                </form>
            </td>
            <td class="right">
                <form action="/wishlist" method="post">
                    <input type="hidden" name="remove_product" value="<?php echo $product['id']; ?>">
                    <button type="submit">
                        <img class="icon" src="icons/trash-outline.svg">
                    </button>
                </form>
            </td>
           
        </tr>


    <?php } ?>

    </tbody>
</table>

<?php } else { ?>
    <p>Die Wunschliste ist leer!</p>
<?php } ?>

<?php require_once __DIR__ . "/../../parts/footer.php"; ?>

