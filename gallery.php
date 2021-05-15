<?php
$galleryactive = "active";
$pagetitle = "Gallery";

  include("header.php")
?>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/gallery.jpg');">
  <div class="overlay"></div>
  <div class="container-fluid">
    <div class="row no-gutters slider-text js-fullheight align-items-end">
      <div class="col-md-9 ftco-animate pb-5">
       <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Gallery <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Gallery</h1>
     </div>
   </div>
 </div>
</section>


<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container-fluid px-md-0">
        <?php
        $cat = mysqli_query($church, "SELECT* FROM gallery_category");
        while($category = mysqli_fetch_array($cat)){
            $id = $category['id'];
            $name =$category['name'];
            // echo $name;
        
        ?>
        <div class="row no-gutters justify-content-center pb-5 mb-3 mt-5 pt-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading"><?php echo ucwords($name)?></span>

                <h2><?php echo ucwords($name)?></h2>
            </div>
        </div>
        <div class="row no-gutters ">
            <?php 
                $gal = mysqli_query($church, "SELECT*  FROM  gallery WHERE category_id = '$id' ORDER BY  RAND()");
                $index =0;
                while($gallery = mysqli_fetch_array($gal)){

                if($index%7){
            ?>

            <div class="col-md-3">
                <a href="admin/<?php echo $gallery['pictures'] ?>" class="image-popup img gallery ftco-animate" style="background-image: url(admin/<?php echo $gallery['pictures'] ?>);">
                    <span class="overlay"></span>
                </a>
            </div>
            <?php }else{
            
            ?>
            <div class="col-md-6">
                <a href="admin/<?php echo $gallery['pictures'] ?>" class="image-popup img gallery ftco-animate" style="background-image: url(admin/<?php echo $gallery['pictures'] ?>);">
                    <span class="overlay"></span>
                </a>
            </div>

            <?php }  ?>
            <?php $index++; } ?>

        </div>

        <?php } ?>
    </div>
</section>

<?php 
    include("footer.php"); 
?>

