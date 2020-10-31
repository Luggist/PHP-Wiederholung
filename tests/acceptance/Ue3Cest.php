<?php 

class Ue3Cest
{
    protected function getCartCount($I)
    {
        $cart = $I->grabTextFrom("header > a");
        preg_match("/\(([0-9]+)\)/", $cart, $matches);
        return (int) $matches[1];
    }

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage("/");

        for ($i=0; $i<20;$i++) {
            $I->click("#product-1 button");
        }
        for ($i=0; $i<10;$i++) {
            $I->click("#product-3 button");
        }

        $I->amOnPage("/cart");
        $heading = $I->grabTextFrom("main > h1");
        $I->assertEquals($heading, "Warenkorb");
    }

    public function testUpdatingProductsInCart(AcceptanceTester $I)
    {
        $values = $I->grabMultiple('[name="update_product"]', "value");
        $quantity = random_int(1, 20);

        foreach ($values as $productId) {
            $I->submitForm('[action="/cart"]', [
                "update_product" => $productId,
                "quantity"       => $quantity
            ]);
        }

        $count = $this->getCartCount($I);
        $I->assertEquals($quantity * count($values), $count);
    }

    public function testRemovingProductsFromCart(AcceptanceTester $I)
    {
        $values = $I->grabMultiple('[name="remove_product"]', "value");

        foreach ($values as $productId) {
            $I->submitForm('.right + td > [action="/cart"]', [
                "remove_product" => $productId
            ]);
        }

        $count = $this->getCartCount($I);
        $I->assertEquals(0, $count);
    }

    public function testNonPositiveQuantities(AcceptanceTester $I)
    {
        $values = $I->grabMultiple('[name="update_product"]', "value");
        $quantities = [0, -100];

        foreach ($values as $index => $productId) {
            $I->submitForm('[action="/cart"]', [
                "update_product" => $productId,
                "quantity"       => $quantities[$index]
            ]);
        }

        $count = $this->getCartCount($I);
        $I->assertEquals(0, $count);
    }
}
