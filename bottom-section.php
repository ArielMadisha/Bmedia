
                </div><!--end page_content-->

            </div>
            <div class="clearfix"></div>
            <!--body wrapper end-->
            <!-- /w3l-agile -->
        </div>
        <!--body wrapper end-->

        <?php require 'template/html/footer.php'; ?>
        <?php require 'template/html/copy.php'; ?>

        <!-- /w3l-agile -->
        <!-- main content end-->
    </section>
	

    <script  src="<?php $_SESSION['root'] ?>/js/jquery.nicescroll.js"></script>
    <script  src="<?php $_SESSION['root'] ?>/js/scripts.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php $_SESSION['root'] ?>/js/bootstrap.js"></script>
    <script src="<?php $_SESSION['root'] ?>/js/loader.js"></script>
	<script  src="<?php $_SESSION['root'] ?>/js/login_create.js"></script>
<script>
$(document).on('click','.showloginboxNew',function(){
		console.log('yes box clicked new');
        $('#loginBox').show();
        $("#loginForm").css("height", 357);
});

$(document).on('click','#close_login',function(){
		 $('#loginBox').hide();
});
</script>