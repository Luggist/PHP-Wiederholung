<?php 

class Ue0Cest
{
    public function testListingProducts(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $heading = $I->grabTextFrom("main > h1");
        $I->assertEquals($heading, "Produkte");

        $countProducts = count($I->grabColumnFromDatabase("products", "id"));

        $htmlIds = $I->grabMultiple("section", "id");
        $productIds = $I->grabMultiple('section > div > form > [name="add_product"]', "value");
        $names = $I->grabMultiple("section > div > h2");
        $descriptions = $I->grabMultiple("section > div > p");
        $prices = $I->grabMultiple("section > div > span");
        $images = $I->grabMultiple("section > img", "src");

        $I->assertCount($countProducts, $htmlIds);
        $I->assertCount($countProducts, $productIds);
        $I->assertCount($countProducts, $names);
        $I->assertCount($countProducts, $descriptions);
        $I->assertCount($countProducts, $prices);
        $I->assertCount($countProducts, $images);

        for($i=0; $i<$countProducts; $i++) {
            $I->assertEquals("product-" . ($i+1), $htmlIds[$i]);

            $I->seeInDatabase("products", [
                "id" => $productIds[$i],
                "name" => $names[$i],
                "description" => $descriptions[$i],
                "price" => (float) str_replace(",", ".", $prices[$i]),
                "image" => $images[$i],
            ]);
        }
    }
}
