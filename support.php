<?php 
    if (isset($_POST['submit'])) {
        try {
            require "../config.php";
            require "../common.php";

            $connection = new PDO($dsn, $user_name, $password, $options);
            
            $sql = "SELECT *
            FROM contacts
            WHERE company = :company";
        
            $company = $_POST['company'];
        
            $statement = $connection->prepare($sql);
            $statement->bindParam(':company', $company, PDO::PARAM_STR);
            $statement->execute();
        
            $result = $statement->fetchAll();
        } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        <!-- Page support-->
        <div data-bs-spy="scroll" data-bs-target="#sideNav" data-bs-offset="0" class="scrollspy-example container-fluid p-0" tabindex="0">
            <!-- Support-->
            <section class="resume-section" id="support">
            <h2>Support</h2>
            <form method="post">
                <label for="company">Company Name</label>
                <input type="text" id="company" name="company" class="form-control-lg">
                <input type="submit" name="submit" value="Ticketstatus abfragen" class="form-control-lg my-5">
            </form>
            <?php
                if (isset($_POST['submit'])) {
                if ($result && $statement->rowCount() > 0) { ?>
                    <h3 class="mt-5">Support-Tickets</h3>

                    <table>
                    <thead>
                <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Tel</th>
                <th>Firma</th>
                <th>Date</th>
                <th>Status</th>
                </tr>
                    </thead>
                    <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["tel"]); ?></td>
                <td><?php echo escape($row["company"]); ?></td>
                <td><?php echo escape($row["date"]); ?> </td>
                <td>N/A</td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    > No results found for <?php echo escape($_POST['company']); ?>.
                <?php }
                } ?>
        </div>
    <?php include "templates/footer.php"; ?>