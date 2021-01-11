    	<script src="alertify/alertify.min.js"></script>
    	<script src="js/jquery.min.js"></script>
	    <script src="js/jquery.actual.min.js"></script>
	    <script src="lib/validation/jquery.validate.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                form_wrapper = $('.login_box');
			    function boxHeight() {
			        form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);   
			    };
			    form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
			    $('.linkform a,.link_reg a').on('click',function(e){
			        	var target  = $(this).attr('href'),
			            target_height = $(target).actual('height');
			        $(form_wrapper).css({
			            'height'        : form_wrapper.height()
			        }); 
			        $(form_wrapper.find('form:visible')).fadeOut(400,function(){
			            form_wrapper.stop().animate({
			                height   : target_height,
			                marginTop: ( - (target_height/2) - 24)
			            },500,function(){
			                $(target).fadeIn(400);
			                $('.links_btm .linkform').toggle();
			                $(form_wrapper).css({
			                    'height'        : ''
			                }); 
			            });
			        });
			        e.preventDefault();
			    });
            });
        </script>
    </body>
</html>