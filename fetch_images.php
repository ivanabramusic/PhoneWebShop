<?php
// DOBIVANJE PHONES IZ DATABASE-A

// Include the database connection
require_once 'db_connect.php';


// Get sorting method from query parameters
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Fetch phones from the database
$sql = "SELECT id, name, price, image, quantity FROM phones";

// Apply sorting based on the selected option
if ($sort == 'name-asc') {
    $sql .= " ORDER BY name ASC";
} elseif ($sort == 'name-desc') {
    $sql .= " ORDER BY name DESC";
} elseif ($sort == 'price-asc') {
    $sql .= " ORDER BY price ASC";
} elseif ($sort == 'price-desc') {
    $sql .= " ORDER BY price DESC";
}

$result = $conn->query($sql);

// Check if there are results and then display them
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card">';
        echo '<img src="'.$row['image'].'" class="card-img-top" alt="'.$row['name'].'">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row['name'].'</h5>';
        echo '<p class="card-text">$'.$row['price'].'</p>';
       
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
            if ($row['quantity'] > 0){
                echo '<button class="btn btn-primary add-to-cart" data-product-id="' . $row['id'] . '">Add to Cart</button>';
            }
            else{
                echo '<p class="text-danger">Out of Stock</p>';
            }
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
