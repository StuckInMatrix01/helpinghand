<?php
    include_once("functions/functions.php");
?>
<div class="panel panel-default sidebar-menu">
    <div class="panel-heading"> <!-- panel handing Start-->
        <h3 class="panel-title">Product Categories</h3>
    </div><!-- panel handing End-->
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked category-menu">
            <?php
                getPCat();
            ?>
        </ul>
    </div>
</div>

<div class="panel panel-default sidebar-menu">
    <div class="panel-heading"> <!-- panel handing Start-->
        <h3 class="panel-title">Filters</h3>
    </div><!-- panel handing End-->
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked category-menu">
           <?php
                getCat();
           ?>
        </ul>
    </div>
</div>