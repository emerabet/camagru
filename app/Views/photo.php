<?php if (isset($my_res) && $my_res['id'] !== null): ?>
<div class="d-flex flex-column justify-content-center align-items-center">
    <div id="my-photo">
        <h1><?php echo htmlspecialchars($my_res['title']); ?></h1>
        <img class="img-fluid" src="upload/<?php echo $my_res['name']; ?>" />
    </div>
    <div id="my-comment" class="my-comment">
        <h4><span id="nbc"><?php echo htmlspecialchars($my_res['nb_comment']); ?></span> Commentaire(s) / <?php echo htmlspecialchars($my_res['nb_upvote']); ?> Like(s)</h4>
        <textarea class="form-control" id="post-com" placeholder="Envoyer un commentaire"></textarea>
        <input id="myname" name="myname" type="hidden" value="<?php echo htmlspecialchars($my_user !== null ? $my_user['name'] : -1); ?>" />
        <input id="idphoto" name="idphoto" type="hidden" value="<?php echo htmlspecialchars($my_res['id']); ?>" />
        <input id="token" name="token" type="hidden" value="<?php echo htmlspecialchars($my_token); ?>" />
        <input id="iduser" name="iduser" type="hidden" value="<?php echo htmlspecialchars($my_user !== null ? $my_user['id'] : -1); ?>" />
        <button id="send-cmt" class="btn btn-primary btn-cmt">Envoyer</button>
        <div id="list-cmt" class="list-group my-list">
        <?php foreach ($my_comments as $key => $value) : 
            $active = $my_user !== null && $value['id_user'] == $my_user['id'] ? 1 : -1;
        ?>     
           <a href="javascript:undefined" class="list-group-item list-group-item-action flex-column align-items-start <?php if ($active === 1): ?>active <?php endif; ?>">
            <div class="d-flex w-100 justify-content-between">
                <small><em><?php echo htmlspecialchars($value['name']); ?></em></small>
                <small><?php echo htmlspecialchars($value['date_com']); ?></small>
            </div>
            <p class="mb-1"><?php echo htmlspecialchars($value['content']); ?></p>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
</div>
<?php else: ?>
<h1>Rien à afficher</h1>
<?php endif; ?>