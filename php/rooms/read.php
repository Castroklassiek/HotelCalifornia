<?php
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password);
$sql = "select * FROM rooms WHERE name = :name";
      $name = $_POST["name"];
      
    $statement = $connection->prepare($sql);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "../../header.php"; ?>
<div class="container-fluid">
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    
    <h2>Result</h2>

    <table class="table">
      <thead class="thead-dark">
<tr>
  <th scope="col">#</th>
  <th scope="col">Name</th>
  <th scope="col">Category</th>
  <th scope="col">Location</th>
  <th scope="col">Description</th>
  <th scope="col">Price</th>
  <th scope="col"></th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["name"]); ?></td>
<td><?php echo escape($row["category"]); ?></td>
<td><?php echo escape($row["location"]); ?></td>
<td><?php echo escape($row["description"]); ?></td>
<td><?php echo escape($row["price"]); ?></td>
<td><?php echo escape($row["image"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['name']); ?>.
  <?php }
} ?>

<h2>search room</h2>

<form method="post">
  <label for="name">Room name</label>
  <input type="text" id="name" name="name">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="../../pages/booking.php">Back to booking</a>
</div>
<?php require "../../footer.php"; ?>