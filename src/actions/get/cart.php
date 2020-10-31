<?php require_once __DIR__ . "/../../parts/header.php"; ?>

<h1>Warenkorb</h1>

<?php if (Cart::instance()->countProductsCart() > 0) { ?>

<table>
    <thead>
        <tr>
            <th>Produkt</th>
            <th>Menge</th>
            <th class="right">Preis</th>
            <th class="right">Gesamt</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    <?php foreach (Cart::instance()->getProductsCart() as $product) { ?>

        < <tr>
            <td>
                <?php echo $product['name']; ?>
            </td>
            <td>
                <form action="/cart" method="post">
                    <input type="hidden" name="update_product" value="<?php echo $product['id']; ?>">
                    <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>">
                    <button type="submit">
                        <img class="icon" src="icons/refresh-outline.svg">
                    </button>
                </form>
            </td>
            <td class="right">
                <?php echo number_format($product['price'], 2, ",", "."); ?>
            </td>
            <td class="right">
                <?php echo number_format($product['total'], 2, ",", "."); ?>
            </td>
            <td>
                <form action="/cart" method="post">
                    <input type="hidden" name="remove_product" value="<?php echo $product['id']; ?>">
                    <button type="submit">
                        <img class="icon" src="icons/trash-outline.svg">
                    </button>
                </form>
            </td>
        </tr>


    <?php } ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">Gesamtsumme</td>
            <td class="right"><?php echo number_format(Cart::instance()->getTotalCart(), 2, ",", "."); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

<a style="margin-top:20px;" class="btn" href="/checkout">Jetzt Kaufen</a>

<?php } else { ?>
    <p>Der Warenkorb ist leer!</p>
<?php } ?>

<?php require_once __DIR__ . "/../../parts/footer.php"; ?>

