<?php
// appears based on a boolean
function displaySuccessAlert($alertContent) { ?>
    <div class="alert alert-success">
        <span class="pull-left full-width">
            <strong><?= $alertContent ?></strong> succesfully. <span class="pull-right has-pointer">Close</span>
        </span>
        <span class="clearfix">
    </div>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        $('.pull-right.has-pointer').click(function() {
            $('.alert').addClass('d-none');
        });
    </script>
<?php } ?>