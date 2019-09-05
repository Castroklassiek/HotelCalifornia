<?php


require "config.php";
try {
  $connection = new PDO($dsn, $username, $password, $options);
  $connection->exec($sql);

  echo "Database and table rooms created successfully.";
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>