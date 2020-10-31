<?php 

class Ue1Cest
{
    protected function getCartCount($I)
    {
        $cart = $I->grabTextFrom("header > a");
        preg_match("/\(([0-9]+)\)/", $cart, $matches);
        return (int) $matches[1];
    }

    public function testAddingProductsToCart(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $heading = $I->grabTextFrom("main > h1");
        $I->assertEquals($heading, "Produkte");

        $initCount = $this->getCartCount($I);

        $I->click("#product-1 button");
        $I->assertEquals($initCount + 1, $this->getCartCount($I));

        $I->click("#product-2 button");
        $I->assertEquals($initCount + 2, $this->getCartCount($I));

        $I->click("#product-3 button");
        $I->assertEquals($initCount + 3, $this->getCartCount($I));
    }
}
