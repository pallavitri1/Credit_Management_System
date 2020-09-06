<?php include "Database_connection.php"; ?>
<?php 




if(array_key_exists("toUserID",$_POST)){
    $user_query = "SELECT * FROM users WHERE ID={$_POST["toUserID"]}";
    
    $display_the_user = mysqli_query($connection,$user_query);
    $row = mysqli_fetch_assoc($display_the_user);
    
    
    $toUserCredits = $row["Current Credit"] + $_POST["NumberCredits"];
    $fromUserCredits = $_POST["fromUserCredits"] - $_POST["NumberCredits"];
    
    $insertion_query = "INSERT INTO `transactions` (`ID of the transferring party`, `Name of the transferring party`, `Email of the transferring party`, `ID of the party receiving credits`, `Name of the party receiving credit`, `Email of the party receiving credit`, `Number of credits transferred`) VALUES ('{$_POST['fromUserID']}', '{$_POST['fromUserName']}', '{$_POST['fromUserEmail']}', '{$row['ID']}', '{$row['Name']}', '{$row['Email']}', '{$_POST['NumberCredits']}');";
    
    
    
    $insert_the_transaction = mysqli_query($connection,$insertion_query);
    
    $update_query_from = "UPDATE `users` SET `Current Credit` = '{$fromUserCredits}' WHERE `users`.`ID` = {$_POST['fromUserID']};";
    $update_query_to = "UPDATE `users` SET `Current Credit` = '{$toUserCredits}' WHERE `users`.`ID` = {$_POST['toUserID']};";
    
    
    mysqli_query($connection,$update_query_from);
    mysqli_query($connection,$update_query_to);
    
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<style>
    
    .tableContainer{
        margin: auto 15%
    }
    
    #buttonContainer{
        margin: auto 35%
    }
    
    body{
        background-color: rgb(179,255,255,0.3)
    }
    
    
    .toggleToUser{
            display: none
    }
    
    </style>
    
    
    

<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="/">Credit Management System</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				
				<li><a href="Home page.php">Home Page</a></li>
				<li><a href="All_Users.php">View All Users</a></li>
				
				
				
				
			</ul>
			
		</div>
		
	</div>
	
</nav>
<div class="tableContainer">
<table class="table table-hover table-bordered">
   <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        
    </tr>
    </thead>
    <tbody>

    <?php
    if($connection){
    $query = "SELECT * FROM users";
    $display_users = mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($display_users)){
    ?>
    <tr>
    <td><a onclick="clickTableRow()" href="View User.php?userid=<?php echo $row["ID"] ?>&username=<?php echo $row["Name"] ?>"><?php echo $row["ID"] ?></a></td>
    <td><?php echo $row["Name"] ?></td>
    
    </tr>
        
    <?php } ?>
     
    
    <?php } ?>
    </tbody>
    </table>
    
    
      
    </div>
    