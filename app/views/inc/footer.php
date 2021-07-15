</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--<script src="--><?php //echo URLROOT; ?><!--/js/main.js"></script>-->
<script>
    $(document).ready(function(){
        $(".bg-transparent").click(function(){
            var comment_id = $(this).data('attr-id');
            $("#child_comment_form_"+comment_id).toggle(function () {
                $("#child_comment_form_"+comment_id).addClass("d-none");
            }, function () {
                $("#child_comment_form_"+comment_id).removeClass("d-none");
            });
        });

        $(".btn-transparent").click(function(){
            var comment_id = $(this).attr('attr-id-data');
            $("#child_comment_show_"+comment_id).toggle(function () {
                $("#child_comment_show_"+comment_id).addClass("d-none");
            }, function () {
                $("#child_comment_show_"+comment_id).removeClass("d-none");
            });
        });
    });

</script>
</body>
</html>
