<?php 

if (isset($_POST['submit'])) {
    require "../config.php";

    try  {
        $connection = new PDO($dsn, $user_name, $password, $options);
        
        $new_contact = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "tel"       => $_POST['tel'],
            "company"  => $_POST['company'],
            "message"  => $_POST['message']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "contacts",
                implode(", ", array_keys($new_contact)),
                ":" . implode(", :", array_keys($new_contact))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_contact);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>
<!-- Page Content-->
<div data-bs-spy="scroll" data-bs-target="#sideNav" data-bs-offset="0" class="scrollspy-example container-fluid p-0" tabindex="0">
    <!-- Contact-->
    <section class="resume-section" id="contact">
    <h2>Contact</h2>
        <form method="post">
            <label for="firstname">Vorname</label>
            <input type="text" name="firstname" id="firstname" class="form-control-lg">
            <label for="lastname">Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control-lg">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control-lg">
            <label for="tel">Telefon</label>
            <input type="text" name="tel" id="tel" class="form-control-lg">
            <label for="company">Firma</label>
            <input type="text" name="company" id="company" class="form-control-lg">
            <label for="message">Nachricht</label>
            <input type="textarea" id="message" class="form-control-lg" rows="3"></input>
            <input type="submit" name="submit" value="Submit" class="form-control-lg my-5">
        </form>
        <?php if (isset($_POST['submit']) && $statement) { ?>
        Hey <?php echo $_POST['firstname']; ?>, danke für die Nachricht, ich melde mich in Kürze bei dir.<br>MfG<br>james
        <?php } ?>
</div>
<?php require "templates/footer.php"; ?>