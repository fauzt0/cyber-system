<div class="container-fluid">

  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="list-group">
        <a href="#" class="list-group-item active">
          Favoritos destacados:
        </a>
          <div id="favoritos">
          <form id="formfavoritos">

            <li class="list-group-item">
              <input type="text" placeholder="Favorito 1" id="fav1" >
              <br>
              <input type="text" placeholder="url: " id="linkfav1" style="width:100%;">
            </li>
            
            <li class="list-group-item">
              <input type="text" placeholder="Favorito 2" id="fav2" >
              <br>
              <input type="text" placeholder="url: " id="linkfav2" style="width:100%;">              
            </li>
            
            <li class="list-group-item">
                <input type="text" placeholder="Favorito 3" id="fav3" >
              <br>
              <input type="text" placeholder="url: " id="linkfav3" style="width:100%;">
            </li>

            <li class="list-group-item">
              <input type="button"  class="btn btn-primary" onclick="addfavorite();" value="Guardar Favoritos">
              <div id="mensaje_fav"></div>
            </li>

          </form>
          </div>
        </div>
    </div>
    

 

    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="http://localhost/cyber-system/conten/img/vid1.png" class="prinIma" alt="Inserta Videos">
        <div class="caption">
          <h3>Agrega multimedia</h3>
          <p>Aquí puedes agregar contenido multimedia en forma de videos
            que tienen fuente en YouTube o cualquier página que permita
            insertar sus propios contenidos internos en sitios externos.

          </p>
          <p><a href="#" class="btn btn-primary" role="button">Nuevo video</a>
           <a href="#" class="btn btn-default" role="button">Nueva imágen</a></p>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="http://localhost/cyber-system/conten/img/vid1.png" class="prinIma" alt="Inserta Videos">
        <div class="caption">
          <h3>Agrega un post</h3>
          <p>Aquí puedes agregar contenido multimedia en forma de videos
            que tienen fuente en YouTube o cualquier página que permita
            insertar sus propios contenidos internos en sitios externos.

          </p>
          <p><a href="#" class="btn btn-primary" role="button">Nuevo +</a>
           <a href="#" class="btn btn-default" role="button">Buscar Videos</a></p>
        </div>
      </div>
    </div>




    <div class="col-sm-6 col-md-3">
      
    </div>

  </div>

  <div class="row">
    
    <div class="col-sm-6 col-md-3">
      <div class="list-group">
        <a href="#" class="list-group-item active">
          Contraseña WIFI:
        </a>
          <div id="favoritos">          

            <li class="list-group-item">
            <LABEL>Contraseña Actual:</LABEL>
            <?php 
              echo '<input type="text"  value="'.$oldWipass.'" id="pass1" disabled="">';
            ?>              
            <LABEL>Nueva Contraseña:</LABEL>
              <input type="password"  id="wifipass">
            </li>        
            
            <li class="list-group-item">
              <input type="button"  class="btn btn-primary" onclick="addwifipass();" value="Guardar Favoritos">
              <div id="mensaje_fav"></div>
            </li>          
          </div>
        </div>
    </div>
    

  </div>

</div>