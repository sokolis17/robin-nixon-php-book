<?php
  require_once 'login.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }


  $query = "DELETE FROM cats WHERE id = '5'";
  $pdo->query($query);
  $query = "SELECT * FROM cats";
  $result = $pdo -> query($query);

  echo "<table border='1' style='border-collapse: collapse; margin: auto; text-align: center;'>
        <th style='text-align: center; padding: 8px;'>Column</th>
        <th style='text-align: center; padding: 8px;'>Type</th>
        <th style='text-align: center; padding: 8px;'>Null</th>
        <th style='text-align: center; padding: 8px;'>Key</th>
      </tr>";
  while ($row = $result->fetch(PDO::FETCH_NUM))
  {
    echo "<tr>";
    for ($k = 0 ; $k < 4 ; ++$k)
      echo "<td style ='text-aligin:center'>" . htmlspecialchars($row[$k]) . "</td>";
    echo "</tr>";
  }

  echo "</table>";
?>
