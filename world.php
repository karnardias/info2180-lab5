<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$lookupcity = $_GET['lookup'] ?? '';
$lookupcountry = $_GET['country'] ?? '';

if ($lookupcity === 'cities') {
     $sql = "SELECT cities.name AS cname, cities.district, cities.population FROM cities 
    JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country
    ORDER BY cities.population DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['country' => "%$lookupcountry%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th> District</th><th>Population</th></tr>";
         foreach ($results as $row) {
        echo "<tr>
            <td>{$row['cname']}</td>
            <td>{$row['district']}</td>
            <td>{$row['population']}</td>
        </tr>";
    }
        echo "</table>";
    } else {
        echo "No cities found.";
    }
}else{

if ($lookupcountry) {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$lookupcountry%"]);
} else {
    $stmt = $conn->query("SELECT * FROM countries");
}
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    echo "<table border='1'>";
    echo "<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";

    foreach ($results as $row) {
        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['continent']}</td>
            <td>{$row['independence_year']}</td>
            <td>{$row['head_of_state']}</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No countries found.";
}
}
?>
