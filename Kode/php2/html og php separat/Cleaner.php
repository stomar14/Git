<?php
// Database connection script
include ("connect.php");


// Clean out expired reservations
$clean = "SELECT c.*, a.avail
		  FROM confirms AS c
		  LEFT JOIN available AS a ON a.roomnum = c.roomnum
		  WHERE c.end_date < NOW()";
$freequery = mysqli_query($connect, $clean) or die (mysqli_error($connect));
$num_check = mysqli_num_rows($freequery);
if ($num_check != 0){
    while ($row = mysqli_fetch_array($freequery, MYSQLI_ASSOC)){
        $id = $row['roomnum'];
        // Delete the reserves
        $sql = "DELETE FROM confirms WHERE roomnum='$id' LIMIT 1";
        $query = mysqli_query($connect, $sql);
        /*Update the database with newly available rooms
        $sql = "UPDATE available SET avail='1' WHERE roomnum LIKE '$id'";*/
        if (mysqli_query($conn, $sql)) {
            echo "Database updated successfully";
        } else {
            echo "Error updating database: " . mysqli_error($conn);
        }
    }
}
?>