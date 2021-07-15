<?php require APPROOT . '/views/inc/header.php'?>
    <div class="jumbotron jumbotron-flud text-center">
        <div class="container">
            <h1 class="display-4"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
        </div>
    </div>
<!--    <div class="row mb-3">-->
<!--        <div class="col-md-6">-->
<!--            <h1>Posts</h1>-->
<!--        </div>-->
<!--    </div>-->
<?php //foreach ($data['posts'] as $post) :?>
<!--    <div class="card card-body mb-3">-->
<!--        <h4 class="card-title">--><?php //echo $post->title; ?><!--</h4>-->
<!--        <div class="bg-light p-2 mb-3">-->
<!--            Written by --><?php //echo $post->name; ?><!-- On --><?php //echo $post->postCreated;?>
<!--        </div>-->
<!--        <p class="card-text">-->
<!--            --><?php //echo $post->body;?>
<!--        </p>-->
<!--    </div>-->
<?php //endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'?>