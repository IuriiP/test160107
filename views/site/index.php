<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully cloned the TEST application.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <?php if (Yii::$app->user->isGuest): ?>
                    <h2>You will be a <?= \app\models\User::find()->count() + 1 ?>'st user</h2>
                    <p class="lead">You need to login first for manage your bookshelves :)</p>
                    <p><a class="btn btn-default" href="/user/login">Login</a></p>
                <?php else: ?>
                    <h2>Hello, <?= Yii::$app->user->identity->username ?></h2>
                    <p class="lead">You can manage your bookshelf.</p>

                    <p><a class="btn btn-lg btn-success" href="/books/index">Manage the Bookshelf</a></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <h2>Presentation</h2>

                <p>There are <?= app\models\Authors::find()->count() ?> authors</p>
                <p>There are <?= app\models\Books::find()->count() ?> books</p>

            </div>
        </div>
    </div>
</div>
