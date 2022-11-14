<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_GET['country']) && !isset($_GET['lookup'])){
  $country=htmlspecialchars($_GET['country']);  
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}elseif(isset($_GET['lookup'])){
  $lookup=htmlspecialchars($_GET['lookup']); 
  $country=htmlspecialchars($_GET['country']);
  $stmt2 = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%'");
  $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

?>

<?php if(isset($country) && !isset($lookup)):?>
  <link href="world.css" type="text/css" rel="stylesheet" />
  <table id='table'>
    <thead>
      <tr>
        <th class='1'>Name</th>
        <th class='2'>Continent</th>
        <th class='3'>Independence Year</th>
        <th class='4'>Head of State</th>
      </tr> 
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
        <tr>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['continent'];?></td>
          <td><?php echo $row['independence_year'];?></td>
          <td><?php echo $row['head_of_state'];?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php if(isset($lookup)):?>
  <link href="world.css" type="text/css" rel="stylesheet" />
  <table id='table'>
    <thead>
      <tr>
        <th class='1'>Name</th>
        <th class='2'>District</th>
        <th class='3'>Population</th>
      </tr> 
    </thead>
    <tbody>
      <?php foreach ($results2 as $row): ?>
        <tr>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['district'];?></td>
          <td><?php echo $row['population'];?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
