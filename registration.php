<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Regitration Details</title>
  </head>
  <body>
    <?php
    extract($_POST);
     ?>
    <table border="1">
      <thead>
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Hobies</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $name;?></td>
          <td><?php echo $age;?></td>
          <td><?php echo $gender;?></td>
          <td><?php echo $address;?></td>
          <td><?php
          for ($i=0; $i < sizeof($hobby) ; $i++) {
            echo $hobby[$i].",";
          }
          ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
