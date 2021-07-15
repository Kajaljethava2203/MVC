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
