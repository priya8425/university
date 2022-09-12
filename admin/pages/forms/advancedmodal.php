<?php
include('../../../configure.php');
?>
<?php
if(isset($_POST['dnk3'])){
  $query=mysqli_query($conn,"select * from instructor where id='".$_POST['dnk3']."'");
  $row=mysqli_fetch_array($query);
  echo ' 
  <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="date">
       Course Name  <span class="text-danger">*</span>
      </label>
      <div class="input-group">
      <input type="hidden" name="id" value="'.$row['id'].'">
         
        <input class="form-control" placeholder="course name" name="course_name" type="text" value="'.$row['instructor'].'" data-dtp="dtp_dl6pL">
        
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
  <label for="date">
  Duration <span class="text-danger">*</span>
  </label>
  <div class="input-group">
   
    <textarea class="form-control" placeholder="duration" name="duration">'.$row['about'].'</textarea>
    
  </div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
  <label for="date">
  Price <span class="text-danger">*</span>
  </label>
  <div class="input-group">
   
    <textarea class="form-control" placeholder="price" name="price">'.$row['courses'].'</textarea>
    
  </div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
  <label for="date">
  Price <span class="text-danger">*</span>
  </label>
  <div class="input-group">
   
    <textarea class="form-control" placeholder="price" name="price">'.$row['students'].'</textarea>
    
  </div>
</div>
</div>
</div>
 <div class="row">
 <div class="col-md-12">
<div class="form-group">
<label for="clock_in">
Image   <span class="text-danger">*</span>
</label>
<div class="input-group">
<input type="file" class="form-control" value="'.$row['image'].'" name="upload_icon" >

</div>
</div>
</div>
 
</div>
';
}


?>