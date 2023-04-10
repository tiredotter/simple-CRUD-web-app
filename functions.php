<?php
    //in the functions below, when user is suplying the input, functions use prep statements, otherwise standard mysqli_query
    
    //show user created sets in user dashbord
    function getUserSets($connection, $user_id){
    $sql = "SELECT * FROM `Sets` WHERE Author_ID=" . $user_id . ";";
    if ($result = mysqli_query($connection, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="set-table"><tbody>';
            while ($row = mysqli_fetch_array($result)) {
                echo (
                    '<tr>'
                    . '<td>'
                    . $row['Set_Name']
                    . '</td>'
                    . '<td><a href="edit.php?curr_ID='. $row['Set_ID'] .'"><img src="icons/edit.svg" style="width:20px; height: 20px;"></a></td>'
                    . '<td><a href="delete.php?curr_ID='. $row['Set_ID'] .'"><img src="icons/trash.svg" style="width:20px; height: 20px;"></a></td>'
                    . '</tr>'
                );
            }
            echo '</tbody></table>';
        } else {
            echo ("Brak notatek!");
        }
    }else{
        echo ("Coś poszło nie tak!");
    }
}
    function logout(){};

    function search(){};
?>
