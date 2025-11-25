<?php
require '../../top-section.php';
// require 'page-data.php'; //this file is loaded by javascript after page loaded
require '../../bottom-section.php';

$cancel = 0;
if($_GET['cancel'] && $_GET['cancel']==1)
{
   $cancel = 1; 
}
?>

<script>
    // $('#upload').addClass('active');
    var page = 'cart';
</script>
<script src="../../res/jquery_ui/js/jquery-ui.min.js"></script>
<script src="cart.js"></script>
<?php
    if (loggedIn() /*&& !$add_image_only*/) {
        // echo '<script src="upload_functions.js"></script>';
    }
?>
<script>
    $(document).ready(function() {
     getCartItems(<?php echo $cancel; ?>);
    });
</script>
<script src="../../js/messages.js"></script>

<?php require '../../closing-section.php'; ?>