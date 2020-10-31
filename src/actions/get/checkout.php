<?php require_once __DIR__ . "/../../parts/header.php"; ?>

<?php

function checkError($key)
{
    return (isset($_SESSION['flash']) &&
        isset($_SESSION['flash']['error']) &&
        isset($_SESSION['flash']['error'][$key]) &&
        $_SESSION['flash']['error'][$key]
    ) ? "error" : "";
}

function checkOld($key)
{
    return (isset($_SESSION['flash']) &&
        isset($_SESSION['flash']['old']) &&
        isset($_SESSION['flash']['old'][$key]) &&
        $_SESSION['flash']['old'][$key]
    ) ? $_SESSION['flash']['old'][$key] : "";
}

function checkCaptcha(){
    if(isset($_POST['submit'])){
        if(($_POST['check']) == $_SESSION['check']) {
            echo 'Input OK';
        } else {
            echo 'Input Wrong';
        }
    }
}
?>

<h1>Checkout</h1>

<p>Füllen Sie die entsprechenden Formulardaten aus um die Bestellung abzuschließen.</p>

<form method="post" action="/checkout">

    <div class="form-group <?php echo checkError("name"); ?>">
        <label for="name">Name *</label><br>
        <input id="name" name="name" value="<?php echo checkOld("name"); ?>">
    </div>

    <div class="form-group <?php echo checkError("street"); ?>">
        <label for="street">Straße *</label><br>
        <input id="street" name="street" value="<?php echo checkOld("street"); ?>">
    </div>

    <div class="form-group <?php echo checkError("place"); ?>">
        <label for="place">Ort *</label><br>
        <input id="place" name="place" value="<?php echo checkOld("place"); ?>">
    </div>

    <div class="form-group <?php echo checkError("country"); ?>">
        <label for="country">Land *</label><br>
        <input id="country" name="country" value="<?php echo checkOld("country"); ?>">
    </div>

    <div class="form-group <?php echo checkError("confirmation"); ?>">
        <input <?php if (checkOld("confirmation")) : ?>checked<?php endif; ?> id="confirmation" type="checkbox" name="confirmation">
        <label for="confirmation">Ich habe die AGB und Datenschutzerklärung gelesen und akzeptiere sie.</label>
    </div>
    <div class="form-group <?php echo checkError("captcha"); ?>">                                                    
          <img src="captcha"><br> Antwort <input id="captcha" name="captcha" value="">

    </div>

    <button style="margin-top:20px;" class="btn" type="submit">Kauf abschließen</button>
    

</form>

<?php require_once __DIR__ . "/../../parts/footer.php"; ?>
