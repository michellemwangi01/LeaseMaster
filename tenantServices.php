<?php
include("header.php");


?> 


<!DOCTYPE html>
<html>
<head>
    <title>Image Grid</title>
    <style>

        body{
            background-color: rgb(231, 225, 225);;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
            width: 80%;
            margin: auto;
            margin-top: 20px;
            margin-bottom: 20px;
            
        }

        .grid img {
            width: 40%;
            height: auto;
            
        }
        p{
            font: 1.2em cursive;
            font-family: Georgia, 'Times New Roman', Times, serif;
            text-align: center;
        }
        .grid-item{
            border: 1px black solid;
            border-radius:  10px;
            background-color: whitesmoke;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="grid">
        <?php
        $images = array(
            array('image_url' => 'maintenance.png', 'text' => 'Maintenance and Repairs'),
            array('image_url' => 'security.png', 'text' => 'Property Security'),
            array('image_url' => 'amenities.png', 'text' => 'Property Amenities'),
            array('image_url' => 'utilities.png', 'text' => 'Utility Management'),
            array('image_url' => 'wifi.png', 'text' => 'High-Speed Internet and Cable'),
            array('image_url' => 'parking.png', 'text' => 'On-Site Parking'),
            array('image_url' => 'events.png', 'text' => 'Community Events'),
            array('image_url' => 'delivery.png', 'text' => 'Package Delivery Solutions'),
            array('image_url' => 'rent.png', 'text' => 'Flexible Lease Terms '),
            array('image_url' => 'portal.png', 'text' => 'Online Tenant Portals')
            
        );

        foreach ($images as $image) {
            $imageUrl = $image['image_url'];
            $text = $image['text'];
            echo '<div class="grid-item">';
            echo '<p>' . $text . '</p>';
            echo '<a href="serviceRequests.php?service=' .htmlspecialchars($text).'"><img src="Images/' . $imageUrl . '" alt="' . $text . '"></a>';
           
           
            echo '</div>';
        }
        ?>
    </div>

    <?php
    include("footer.php");
    ?> 
    <script>
        
    </script>
</body>
</html>

