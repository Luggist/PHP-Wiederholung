<?php 

class Ue2Cest
{
    protected function toFloat($number, $fraction)
    {
        return (float) ($number . "." . $fraction);
    }

    public function testListingCart(AcceptanceTester $I)
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

        $rows = $I->grabMultiple("tbody tr");
        $I->assertCount(2, $rows);

        preg_match("/(\d+?),(\d{2})\s+?(\d+?),(\d{2})/", $rows[0], $matches_row1);
        preg_match("/(\d+?),(\d{2})\s+?(\d+?),(\d{2})/", $rows[1], $matches_row2);
        $quantities = $I->grabMultiple('tbody input[name="quantity"]', 'value');

        $total1 = $this->toFloat($matches_row1[1], $matches_row1[2]) * $quantities[0];
        $total2 = $this->toFloat($matches_row2[1], $matches_row2[2]) * $quantities[1];

        $I->assertEquals($total1, $this->toFloat($matches_row1[3], $matches_row1[4]));
        $I->assertEquals($total2, $this->toFloat($matches_row2[3], $matches_row2[4]));

        $total = $I->grabTextFrom("tfoot td[colspan] + td");
        $I->assertEquals($total, number_format($total1 + $total2, 2, ",", "."));
    }
}
