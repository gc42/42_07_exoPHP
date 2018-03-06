<?php $title = 'Super Blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour vers les news</a></p>


<!-- DISPLAY SELECTED POST -->
<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']); ?>
        <i>&nbsp;&nbsp;&nbsp;
            le <?= $post['creation_date_fr']; ?>
        </i>
    </h3>
    <p>
        <?= htmlspecialchars($post['content']); ?>
    </p>
</div>
	
	


<!-- DISPLAY COMMENTS RELATED WITH SELECTED POST -->
<h2>Commentaires</h2>

<?php
while ($data = $comments->fetch())
{
?>

    <div class="commentaires">
        <p>
            <span class="who">
                <i>
                    <strong>
                        <?= htmlspecialchars($data['author']); ?>
                    </strong>
                    <small>le 
                        <?= $data['comment_date_fr']; ?>
                    </small>
                </i>
            </span><br />
            
            <?= nl2br(htmlspecialchars($data['comment'])); ?>
        </p>
    </div>

<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>