<?php 

class Ue5Cest
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

        for ($i=0; $i<5;$i++) {
            $I->click("#product-1 button");
        }
        for ($i=0; $i<5;$i++) {
            $I->click("#product-3 button");
        }

        $I->amOnPage("/cart");
        $I->click("Jetzt Kaufen");
    }

    public function testAddingOrder(AcceptanceTester $I)
    {
        $rand = random_int(100, 999);

        $data = [
            "name"         => "test name "    . $rand,
            "street"       => "test street "  . $rand,
            "place"        => "test place "   . $rand,
            "country"      => "test country " . $rand,
            "confirmation" => "on"
        ];

        $I->submitForm('form', $data);

        $heading = $I->grabTextFrom("main > h1");
        $I->assertEquals($heading, "Kauf erfolgreich abgeschlossen!");

        $count = $this->getCartCount($I);
        $I->assertEquals(0, $count);

        $I->seeInDatabase("orders", ["name" => "test name $rand"]);
        $orderId = $I->grabFromDatabase("orders", "id", ["name" => "test name $rand"]);

        $I->seeNumRecords(2, "order_items", ["order_id" => $orderId]);
    }
}
