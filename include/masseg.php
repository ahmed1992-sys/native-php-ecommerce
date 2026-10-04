<?php
if(isset($_SESSION['error'])){?>
<div class="alert alert-danger text-center mb-4" role="alert">
    <i class="fas fa-exclamation-circle"></i>
    <?=  $_SESSION['error'] ?>
    </div>
<?php
unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){?>
<div class="alert alert-success text-center " role="alert">
    <?=  $_SESSION['success'] ?>
    </div>
<?php


unset($_SESSION['success']);

}
?>