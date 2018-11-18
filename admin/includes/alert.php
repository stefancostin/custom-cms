<?php
// Success alert displays based on a boolean
function displaySuccessAlert($alertContent, $auxContent = "") { ?>
    <div class="alert alert-success">
        <span class="pull-left full-width">
            <strong><?= $alertContent ?></strong> succesfully. 
            <?php
                if($auxContent) { ?>
                    <span><?= $auxContent ?></span>
                <?php }
            ?> 
            <span class="pull-right has-pointer">Close</span>
        </span>
        <span class="clearfix">
    </div>
<?php } 
// Error alert displays based on a boolean
function displayErrorAlert($alertContent, $auxContent = "") { ?>
    <div class="alert alert-danger">
        <span class="pull-left full-width">
            <strong><?= $alertContent ?></strong> failed. 
            <?php
                if($auxContent) { ?>
                    <span><?= $auxContent ?></span>
                <?php }
            ?> 
            <span class="pull-right has-pointer">Close</span>
        </span>
        <span class="clearfix">
    </div>
<?php } ?>