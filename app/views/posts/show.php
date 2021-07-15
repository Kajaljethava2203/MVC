<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<div class="jumbotron jumbotron-flud ">
<h1><?php echo $data['post']->title; ?></h1>
<?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
<!--    <hr>-->

    <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="DELETE" class="btn btn-danger" style="margin-left: 20px">
    </form>

    <form class="pull-right " method="post">
        <a href="<?php echo URLROOT;?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">EDIT</a>
    </form>
  <br><br>

<?php endif; ?>
<div class="bg-secondary text-white p-2 mb-3">
    Written By <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>

<p><?php echo $data['post']->body; ?></p>

<form action="<?php echo URLROOT; ?>/posts/comment/<?php echo $data['post']->id; ?>" method="post">
    <h5>Comments</h5>
    <div class="form-group">
        <textarea name="comment" rows="5" class="form-control <?php echo (!empty($data['comment_err'])) ? 'is-invalid' : '';?><?php echo $data['comment']; ?>"></textarea>
        <span class="invalid-feedback"><?php echo $data['comment_err']; ?></span>
        <!--    <textarea class="form-control " name="comment"  rows="5" placeholder="Enter comments.." ></textarea>-->
    </div>
    <input type="submit" class="btn btn-success" value="Submit">

</form>
    <?php foreach ($data['comments'] as $comment) :
        ?>

        <div class="media text-muted pt-3 col-md-12">
<!--             <img data-src="holder.js/32x32?theme=thumb&amp;bg=e83e8c&amp;fg=e83e8c&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="--><?php //comment_user_image($comment->userName);?><!--" data-holder-rendered="true">-->
            <p class="media-body pb-2 mb-0 small lh-125 border-bottom border-gray">

                <strong class="d-block text-gray-dark" style="font-size: 18px;color: blue">@<?= $comment->userName ?></strong>
                <strong class="d-block text-gray-dark" style="font-size: 16px"><?= $comment->commentCreated ?></strong>
                <strong class="d-block text-black-dark" style="font-size: 15px"> <?=  $comment->commentText ?></strong><br>


                <?php if ($comment->userId == $_SESSION['user_id']) { ?>
                <form action="<?= URLROOT ?>/posts/deleteComm/<?= $comment->commentId ?>" method="POST" class="pull-right">
                <input type="submit" name="" class="btn btn-link" value="Delete">
            </form>
            <?php }else { ?>

                <?php ?>
                <form action="#" method="POST" class="pull-right">
                    <input type="submit" name="" class="btn btn-link" value="Follow">
                </form>
            <?php } ?>

            </p>

        </div>
        <button class="btn btn-link pull-right bg-transparent" id="<?= $comment->commentId?>" data-attr-id="<?= $comment->commentId?>"><i class="fa fa-reply" aria-hidden="true"></i> </button>
        <form method="POST" action="<?= URLROOT ?>/posts/replay/<?= $data['post']->id ?>" class="d-none" id="child_comment_form_<?= $comment->commentId ?>">
            <input type="text " name="comment_reply" class="form-control col-md-10 ml-5" placeholder="Press Enter To Comment" required>
            <input type="hidden" name="parent_comment_id" class="" placeholder="" value="<?= $comment->commentId ?>">
        </form>
    <?php foreach ($data['comments'] as $comments) :?>

        <!--             <img data-src="holder.js/32x32?theme=thumb&amp;bg=e83e8c&amp;fg=e83e8c&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="--><?php //comment_user_image($comment->userName);?><!--" data-holder-rendered="true">-->
        <p class="media-body pb-2 mb-0 small lh-125 border-bottom border-gray">

            <strong class="d-block text-gray-dark" >@<?= $comments->userName ?></strong>
            <strong class="d-block text-gray-dark"><?= $comments->commentCreated ?></strong>
            <strong class="d-block text-black-dark"> <?=  $comments->commentText ?></strong><br>
        </p>
            <?php endforeach; ?>

    <?php endforeach; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

