<?php
 session_start();
 include("connection.php");
 if(isset($_SESSION['phonenumber'])){
   $usernumer  =$_SESSION['phonenumber'];
   $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
   $admin = mysqli_fetch_array($qu);
   $adminarea = $admin['admintype'];
   $success = $fail="";
//  }

    $ife =[];
    function test_input($data) 
      {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }
      if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
            if (empty($_POST["addcategories"])) {
                $CategoriesErr = "Input is required";
                $ife[]="Input is required";
                } else {
                $categories = test_input($_POST["addcategories"]);

            }
            if(count($ife)==0){
                $categories = test_input($_POST["addcategories"]);
                $new="INSERT INTO categories(catgories) VALUE ('$categories')";
                $adten= mysqli_query($church,$new);
                if($adten){
                    $success = "New category created successfully";
                }
                else{
                    $fail  ="New category fail to create ".mysqli_error($church);
            }
            }
        }


        if(isset($_POST['updateCategory']))
        {
            $categories = $_POST['category'];
            $id =  $_POST['ido'];
            $edit= mysqli_query($church,"UPDATE categories set catgories='$categories' WHERE id= $id");

        if ($edit) {
            $success =  "Category updated successfully";
        }
        else {
            $fail = "Category failed to update ". mysqli_error($church);
        }
       }

       if(isset($_POST['delCategory']))
       {    $ife = $_POST['delCategory'];
           $ayo =  $_POST['idbutton'];
           $delet = " DELETE FROM categories  WHERE id= $ayo ";
           $fsele = mysqli_query($church,$delet);

       if ($fsele) {
           $success=  "Category deleted successfully";
       }
       else {
           $fail= "Category fail to delete ". mysqli_error($church);
       }
      }

      $pagetitle = "Add new category";
      $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

      include('header.php')
    
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <button class="btn btn-success fa fa-file" data-toggle="modal" data-target="#odal" > <span class="p-1">Add new categories</span> </button>
          </div>
          <div class="modal fade" id="odal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title text-dark">Add to Categories</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-dark">
                <form role="form" action="categories.php" method="post">
                      <div class="card-body ">
                        <div class="form-group">
                          <label for="Topic">Add to categories</label>
                          <input type="text" class="form-control" name="addcategories" id="addcategories" >
                        </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                      </div>
                    </form>
                </div>
<!-- 
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->

              </div>
            </div>
        </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
        <?php
        if(isset($success) && !empty($success)){
        ?>
        <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?php echo  $success ?>
      </div>
        <?php } ?>

        <?php
        if(isset($fail) && !empty($fail)){
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Failed!</strong> <?php echo  $fail ?>
      </div>
        <?php } ?>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Manage Sermon Categories
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <?php
         $select= "SELECT* FROM categories ORDER BY id DESC";
         $fselect = mysqli_query($church,$select);
         $i = 0;
             ?>
        <div class="row">
          <div class="col">
          <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>id </th>
                            <th>Categories</th>
                            <th>Date added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                 while($ffselec= mysqli_fetch_array($fselect)){

                        ?>
                        <tr>
                        <?php echo '<td>' . ++$i.'</td>' ;?>
                        <?php echo '<td>'. ucfirst($ffselec['catgories']) .'</td>' ;?>
                        <?php echo  '<td>'.$ffselec['reg_date'] .'</td>'; ?>
                            <td>
                              <div class="row ">
                                  <i title="Edit Sermon"  id="<?php echo $ffselec['id'] ;?>" category= <?php echo $ffselec['catgories']; ?> data-toggle="modal" data-target="#editCategory"  class="fa fa-edit p-2" style="font-size:25px;color:white;border:solid white 5px;border-radius:5px; background-color:blue;" >
                            </i>
                            <i title="Delete Sermon"  id="<?php echo $ffselec['id'] ;?>" category= <?php echo $ffselec['catgories']; ?> data-toggle="modal" data-target="#delModal" class=" fa fa-trash p-2" style="font-size:25px;color:white;border:solid white 5px; background-color:red; border-radius:5px;" >
                            </i>
                              </div>

                          
                        </td>
                    </tr>
                    <?php      
            }    ?>

                </tbody>
            </table>

          <div class="modal fade" id="delModal">
          <div class="modal-dialog modal-lg">
            <form role="form" action="categories.php" method="post">
            <div class="modal-content" >
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title text-dark">Are you sure you want to delete? <span id="delCategoryValue" name="delCategory"></span></h4>
                  <!-- <h4 class="modal-title text-dark"" name="delCategory"></h4> -->
                  <input type="hidden" class="modal-title text-dark" id="deleteCategoryValue" name="idbutton"></input>
                  <button type="button" class="close" name= "idbutton" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger" name="delCategory" >Yes</button>
                  <button type="button" class="btn btn-success" data-dismiss="modal" >No</button>
                </div>

              </div>

            </form>
            </div>
          </div>
    
            <div class="modal fade" id="editCategory">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title text-dark">Edit Categories</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body text-dark">
                    <form role="form" id ="updateCategoryForm" method="post" action="categories.php">
                          <div class="card-body ">
                            <div class="form-group">
                              <label for="Topic">Edit categories</label>
                              <input type="text" value="" class="form-control" id="editCategoryValue" name="category" placeholder="Input the category here">
                            </div>
                            <input type="hidden" value="" id="ourCategory" name="ido">
                          <!-- /.card-body -->
                          <div class="card-footer">
                            <button type="submit" name="updateCategory" class="btn btn-primary">Edit</button>
                          </div>
                        </form>
                    </div>

                    <!-- Modal footer -->

                  </div>
                </div>
            </div>

          </div>
        </div>         
    </section>
</div>
<?php
 include("footer.php");
}else{
  header('location:index.php');
}

?>
<script>
  $('#editCategory').on('show.bs.modal',function(e){
      var mycat = $(e.relatedTarget).attr('category');
      var id = $(e.relatedTarget).attr('id');
      $("#editCategoryValue").val(mycat);
      $("#ourCategory").val(id);
  })
  $('#delModal').on('show.bs.modal',function(e){
    var mycategory = $(e.relatedTarget).attr('category');
    var ido = $(e.relatedTarget).attr('id');
    $("#delCategoryValue").text(mycategory);
      $("#deleteCategoryValue").val(ido);


  })

</script>