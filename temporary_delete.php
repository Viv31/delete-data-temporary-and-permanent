<?php 
	 require_once('config.php');
	//echo $_SESSION['username'];
	$uid = $_POST['del_id'];
	$deactive = 1;
	$sql = $conn->prepare("UPDATE `item` SET `is_deleted`= '".$deactive."' WHERE id = ? ");  
	$sql->bind_param("i", $uid); 
	$sql->execute();
	if($sql->execute()){
				   		echo "YES";
				   	}
				   	else{
				   		echo "NO";
				   	}
	
		
?>