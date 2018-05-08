<div class="row">
    <div class="col-sm-12">
        <button id="btn-onoff" class="btn btn-secondary">Start/Stop</button>
        <button id="btn-take" class="btn btn-info">Prendre une photo</button>
    </div>
</div>
<div class="row">
    <p id="video-text" class="video-text">Veuillez demarrer la cam pour prendre des photos</p>
    <div class="col-sm-12">
        <div id="my-wrapper" class="my-wrapper">
           <!--  <img class="img-fluid my-deco" src="img/hadoken.png" /> -->
            <video id="embed-video" class="embed-responsive embed-responsive-4by3 my-video" style="display: none;"></video>
        </div>
        <canvas id="canvas" class="embed-responsive embed-responsive-16by9" style="display: none;" height="300">
              Sorry, your browser doesn't support the &lt;canvas&gt; element.
        </canvas>
    </div>
</div>
<div id="set-img" class="d-flex align-content-stretch flex-wrap my-area"><img id="img-hado" draggable="true" class="img-fluid" src="img/hadoken.png" /><img id="img-champ" draggable="true" class="img-fluid" src="img/champ.png" /></div>