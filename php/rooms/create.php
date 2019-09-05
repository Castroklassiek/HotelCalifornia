<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_room = array(
      "name" => $_POST['name'],
      "category" => $_POST['category'],
      "location" => $_POST['location'],
      "description" => $_POST['description'],
      "price" => $_POST['price'],
      "image" => $_POST['image'],
      
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"rooms",
implode(", ", array_keys($new_room)),
":" . implode(", :", array_keys($new_room))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_room);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "../../header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
   <?php echo $_POST['name']; ?> Room successfully added.
<?php } ?>

<div class="container">
<div class="jumbotron">  
<h2>add a room</h2>  

  <form method="post">
       <div class="form-group">
    	<label for="name">Room name</label>
    	<input type="text" name="name" id="name">
      </div>
      <div class="form-group">
    	<label for="category">Category</label>
    	<input type="text" name="category" id="category">
      </div>
      <div class="form-group">
    	<label for="location">Location</label>
    	<input type="text" name="location" id="location">
      </div>
      <div class="form-group">
    	<label for="description">Description</label>
    	<input type="text" name="description" id="description">
      </div>
      <div class="form-group">
    	<label for="price">Price</label>
    	<input type="text" name="price" id="price">
      </div>
      <div class="form-group">
    	<label for="image"></label>
    	<input type="text" name="image" id="image">
      </div>
    	<input type="submit" name="submit" value="Bevestig">
    	
    </form>

    <a href="../../pages/booking.php">Back to booking</a> 
</div> 
    </div> 

   
<?php require "../../footer.php"; ?>