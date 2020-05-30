<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Button disabled untill form is not filled</title>
	<!-- Latest compiled and minified CSS -->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

 <style>

body{
    background: rgb(2,0,36);
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
}



  
</style>
</head>
<body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 bg-dark">
      <h2 class="text-white text-center" style="margin-top: 10px;">Delete Data</h2>
    </div>
      <div class="col-md-6 mt-5 mx-auto" id="permanent_delete_box">
          <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong>Item Deleted Permanently.
      </div>
  </div>
  <div class="col-md-6 mt-5 mx-auto" id="temporary_delete_box">
          <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong>Item Deleted Temporarily.
      </div>
  </div>
    <div class="col-md-8 mx-auto" style="margin-top: 5px;">
      <table class="table table-dark table-hover" id="job_history">
              <thead >
                <tr>
                  <th>Sno<?php $sno='1';?></th>
                  <th>item Name</th>
                 
                  <th colspan="2" style="text-align: center;">Action</th>
                  
                </tr>
              </thead>
               <tbody>
                <?php 
                
          
  $getall_data = "SELECT `id`, `item_name`, `is_deleted` FROM `item` WHERE is_deleted = 0";
  $getall_data = mysqli_query($conn,$getall_data);
  if(mysqli_num_rows($getall_data)>0){

   //while ($view_users_data ->fetch()) {
    while($view_data = mysqli_fetch_assoc($getall_data)) {
  ?>
  

                      <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php  echo $view_data['item_name'];?></td>
                        
                        <td>
                          <?php $id = $view_data['id']; ?>
            <a href="#" class="btn btn-danger temp_del" id="<?php echo $id;?>">Temporary Delete</a>
        </td>
         <td>
                          <?php $id = $view_data['id']; ?>
            <a href="#" class="btn btn-danger per_del" id="<?php echo $id;?>">Delete Permanent</a>
        </td>
                        
                      </tr>
                      <?php
 } 
}
else{
  ?>
  <tr>
    <td colspan="3">No data found </td>
  </tr>
<?php
}
?>

    
 
                         </tbody>
  </table>
    </div>
    </div>

    </div>
    <script>
 $(document).ready(function(){

  $("#temporary_delete_box").hide();
$('.temp_del').click(function(){

 var del_id = $(this).attr('id');
//alert(del_id);
 var $ele = $(this).parent().parent();

var conf = confirm("Do You want to delete this");
if(conf){
        $.ajax({
                type:'POST',
                url:'temporary_delete.php',
                 data:{del_id:del_id},
                success: function(data){
                   if(data == "YES"){
                    $ele.fadeOut().remove();
                    $("#temporary_delete_box").show();
                    
                 }
                 else{
                        alert("can't delete the row");
                        
                 }
                }

                });

}

});

});

</script>


<script>
 $(document).ready(function(){

  $("#permanent_delete_box").hide();
$('.per_del').click(function(){

 var del_id = $(this).attr('id');
//alert(del_id);
 var $ele = $(this).parent().parent();

var conf = confirm("Do You want to delete this");
if(conf){
        $.ajax({
                type:'POST',
                url:'permanent_delete.php',
                 data:{del_id:del_id},
                success: function(data){
                   if(data == "YES"){
                    $ele.fadeOut().remove();
                    $("#permanent_delete_box").show();
                    
                 }
                 else{
                        alert("can't delete the row");
                        
                 }
                }

                });

}

});

});

</script>

  </body>
  </html>