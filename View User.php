


<?php include "body.php"; ?>

<?php

    
if (array_key_exists("userid",$_GET)){
    $query = "SELECT * FROM users where ID={$_GET["userid"]}";
    
    $display_the_user = mysqli_query($connection,$query);
    $row1 = mysqli_fetch_assoc($display_the_user);
    if(isset($row1)){
        $fromID = $row1["ID"];
        $fromUserName = $row1["Name"];
        $fromUserEmail = $row1["Email"];
        
        $fromUserCredits = $row1["Current Credit"];
}
}
    
?>


<div class="tableContainer">
<form action="All_Users.php" method="POST">
    <h4>Transfer Credits from:</h4>
    <div class="transferCredit displayDetails form-group">
    <label for="fromUserID">ID:</label>
    <input class="form-control" type="number" id="fromUserID" name="fromUserID" min="1" value="<?php echo $fromID ?>" readonly>
    <div class="transferCredit displayDetails form-group">
    <label for="fromUserName">Name:</label>
    <input class="form-control" type="text" id="fromUserName" name="fromUserName" value="<?php echo $fromUserName ?>" readonly>
    </div>
    <div class="transferCredit displayDetails form-group">
    <label for="fromUserEmail">Email:</label>
    <input class="form-control" type="text" id="fromUserEmail" name="fromUserEmail" value="<?php echo $fromUserEmail ?>" readonly>
    </div>
    <div class="transferCredit displayDetails form-group">
    <label for="fromUserCredits">Current Credits:</label>
    <input class="form-control" type="number" id="fromUserCredits" name="fromUserCredits" value="<?php echo $fromUserCredits ?>" readonly>
    </div>
    <div id="buttonContainer">
    <button type="button" class="btn btn-lg btn-primary" onclick="clickTransferButton()">Click here to choose recipient</button>
    </div>
    </div>
    
    
    
    <div class="toggleToUser" id="toggleToUser">
    <h4>Transfer Credits to:</h4>
    <div class="form-group">
    <label for="toUserID">ID</label>
    <input class="form-control" type="number" id="toUserID" name="toUserID" min="1" readonly>
    </div>
    <div class="transferCredit displayDetails form-group">
    <label for="toUserName">Name</label>
    <input class="form-control" type="text" id="toUserName" name="toUserName" readonly>
    </div>
    <div class="transferCredit displayDetails form-group">
    <label for="toUserEmail">Email</label>
    <input class="form-control" type="text" id="toUserEmail" name="toUserEmail" readonly>
    </div>
    <div class="transferCredit displayDetails form-group">
    <label for="toUserCredits">Current Credits</label>
    <input class="form-control" type="number" id="toUserCredits" name="toUserCredits" readonly>
    </div>
    <div class="form-group">
    <label for="NumberCredits">Enter the number of credits to transfer:</label>
    <input type="number" id="NumberCredits" name="NumberCredits" class="form-control">
    </div>
    <div id="buttonContainer">
    <button type="submit" class="btn btn-lg btn-primary" >Transfer Credit Points</button>
    </div>
    </div>
    
    
    
    </form>
    </div>
    <script>
        
        var fromCreditValue = document.getElementById("NumberCredits").setAttribute("max",document.getElementById("fromUserCredits").value)
        function clickTransferButton(){
            var toDiv = document.getElementById("toggleToUser");
            toDiv.classList.toggle("toggleToUser");
            alert("Click on the ID of the user in the table to auto-populate recipient details");
            window.scrollTo(0,document.body.scrollHeight);
        }
        
        function clickTableRow(){
            
            var row1 = event.target
            //var row2 = event.target.children[1];
            
            if(document.getElementById("fromUserID").value===row1.innerText){
                alert("The ID of the transferring party and recipient cannot be the same");
            }
            else{
            document.getElementById("toUserID").value = row1.innerText;
            user={};
            user.ID=document.getElementById("toUserID").value;
            //document.getElementById("toUserName").value = row2.innerText;
            $.ajax({
                url:'test.php',
                method:'post',
                
                data:user,
                success:function(res){
                var fields = res.split(">");
                document.getElementById("toUserName").value = fields[0];
                document.getElementById("toUserEmail").value = fields[1];
                document.getElementById("toUserCredits").value = fields[2];
                
            }
                
                

            });
            }
        }
        
        var table_row = document.getElementsByTagName("tr");
        for(i=1;i<table_row.length;i++){
            
            var anchor_link = table_row[i].children[0].children[0];
            anchor_link.setAttribute("href","#");
            
            
        }
        
        
        
        
        
            
            
        
        
     </script>
     
     

    </body>
</html>
    
                                                        