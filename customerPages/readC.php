<?php
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

//if (isset($_POST['submit'])) {
  try {
    require "../php/rooms/config.php";
    require "../php/rooms/common.php";

    $connection = new PDO($dsn, $username, $password);

  } catch(PDOException $error) {
    echo "geen verbinding";
  }
//}
?>
<!--..............................

.................................-->

<?php require "../header.php"; ?>
<script>
$(document).ready(function () {
    var minDate = new Date();
    $("#checkin").datepicker({
        showAnim: 'drop',
        numberOfMonth: 1,
        minDate: minDate,
        dateFormat:'dd/mm/yy',
        onClose: function (selectedBeginDate) {
            $('#checkout').datepicker("option" ,"minDate",selectedDate);
        }
    });
    
        $("#checkout").datepicker({
        showAnim: 'drop',
        numberOfMonth: 1,
        minDate: minDate,
        dateFormat:'dd/mm/yy',
        onClose: function (selectedEndDate) {
            $('#checkin').datepicker("option" ,"minDate",selectedDate);
        }
    });
    
});

</script>


<div class="container-fluid">
<!-- Datepicker -->

<form action="" id="formB" method="post">
    <input type="text" id="checkin" name="checkin" placeholder="Check In">
    <input type="text" id="checkout" name="checkout" placeholder="Check Out">
    <select id="adults" name="adults">
     <option>Adults</option>
     <option value="1">1</option>
     <option value="2">2</option>
    </select>
    <select id="children" name="children">
    <option>Children</option>
    <option value="1">1</option>
     <option value="2">2</option>
    </select>
    <select id="infants" name="infants">
    <option>Infants</option>
    <option value="1">1</option>
     <option value="2">2</option>
        </select>
    <input type="submit" name="submit" value="Search">
</form>

   
     
<?php
    function translateDate($date){
        $date = explode('/',$date);
        $returnDate = $date[2].'-'.$date[1].'-'.$date[0];
        return $returnDate;
    }
if (isset($_POST['submit'])) { 
    $name = $_POST["name"];
    $adults = $_POST["adults"];
    $children = $_POST["children"];
    $infants = $_POST["infants"];
    
    $datesFrom =translateDate($_POST['checkin']);
    $datesTill=translateDate($_POST['checkout']);
    
    //echo $datesFrom.'tot'.$datesTill;
    
    $sql = "select * FROM rooms WHERE date_in >= :datein
                OR date_out >= :dateout";
      
      
    $statement = $connection->prepare($sql);
    
    $statement->bindParam(':datein', $datesFrom, PDO::PARAM_STR);
    $statement->bindParam(':dateout', $datesTill, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
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
  <th scope="col">Foto</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) {
          if($row['available']==1){?>
              <tr class="text-success">
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["name"]); ?></td>
<td><?php echo escape($row["category"]); ?></td>
<td><?php echo escape($row["location"]); ?></td>
<td><?php echo escape($row["description"]); ?></td>
<td><?php echo escape($row["price"]); ?></td>
<td><?php echo escape($row["image"]); ?></td>
      </tr>
          <?php } else {?> 
          <tr class="text-danger">
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["name"]); ?></td>
<td><?php echo escape($row["category"]); ?></td>
<td><?php echo escape($row["location"]); ?></td>
<td><?php echo escape($row["description"]); ?></td>
<td><?php echo escape($row["price"]); ?></td>
<td><?php echo escape($row["image"]); ?></td>
      </tr>
          <?php }
          ?>
      
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['name']); ?>.
  <?php }
} ?>
<!--
<form method="post">
  <label for="name">Room name</label>
  <input type="text" id="name" name="name">
  <input type="submit" name="submit" value="View Results">
</form>
-->
</div>
<?php require "../footer.php"; ?>