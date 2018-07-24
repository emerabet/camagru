<div id="set-tool" class="d-flex justify-content-start my-area">
    <button id="btn-webcam" class="btn">Webcam</button>
    <label class="btn btn-primary" for="my-file-selector">
        <input id="my-file-selector" type="file" accept=".png,.jpg,.jpeg,.gif,.bmp" onchange="readURL(this);" style="display:none;">
        Upload
    </label>
    <input type="text" id="title-img" placeholder="Choisir un titre" value=""/>
    <button id="zoom-out" class="btn btn-info disabled" style="display:none;">-</button>
    <button id="zoom-in" class="btn btn-info disabled" style="display:none;">+</button>
    <button id="btn-take" class="btn btn-info disabled" style="display:none;">Prendre une photo</button>
    <button id="btn-save" class="btn btn-success disabled" style="display:none;">Sauvegarder</button>
    <button id="btn-cancel" class="btn btn-warning" style="display:none;">Annuler</button>
</div>
<div class="row">
    <div class="col-sm-12">
        <div id="my-wrapper" class="my-wrapper">
            <video id="embed-video" class="embed-responsive embed-responsive-4by3 my-video"></video>
            <canvas id="canvas" class="embed-responsive embed-responsive-16by9" style="display: none;" height="300">
              Sorry, your browser doesn't support the &lt;canvas&gt; element.
            </canvas>
        </div>
    </div>
</div>
<div id="set-img" class="d-flex align-content-stretch flex-wrap my-area">
    <img id="img-hado" draggable="true" class="img-fluid" src="img/hadoken.png" />
    <img id="img-champ" draggable="true" class="img-fluid" src="img/champ.png" />
</div>