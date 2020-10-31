<?php 

class Ue4Cest
{
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
        $I->click("Jetzt Kaufen");

        $heading = $I->grabTextFrom("main > h1");
        $I->assertEquals($heading, "Checkout");
    }

    public function testFillCheckoutFormWithErrors(AcceptanceTester $I)
    {
        foreach (["name", "street", "place", "country", "confirmation"] as $index => $key) {
            $data = [
                "name"         => "test name",
                "street"       => "test street",
                "place"        => "test place",
                "country"      => "test country",
                "confirmation" => "on"
            ];

            $data[$key] = "";
            $I->submitForm('form', $data);
            $name = $I->grabAttributeFrom(".error > input", "name");
            $I->assertEquals($key, $name);
        }
    }

    public function testFillCheckoutForm(AcceptanceTester $I)
    {
        $I->submitForm('form', [
            "name"         => "test name",
            "street"       => "test street",
            "place"        => "test place",
            "country"      => "test country",
            "confirmation" => "on"
        ]);

        $heading = $I->grabTextFrom("main > h1");
        $I->assertEquals("Kauf erfolgreich abgeschlossen!", $heading);
    }
}
