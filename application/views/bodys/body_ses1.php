<div class="container-fluid">

  <div class="row">
  <!--insercion -->
  <div class="col-sm-6 col-md-3">
      <div class="col-sm-12 col-md-12">
        <div class="list-group">
          <a href="#" class="list-group-item active">
            -Favoritos destacados:
          </a>
          <div id="favoritos">
            <form id="formfavoritos">
            <!-- Data buffer -->
              <?php 
                switch ($favorites3[0][0]) {
                  case 0:
                    echo '<li class="list-group-item">No se tienen favoritos en la base de datos</li>';
                  break;
                  case 1://se despliegan los resultados 
                    for ($i=1; $i<=3; $i++) { 
                      $j = 1;//const.
                      $k = 0;//const.
                      echo'<li class="list-group-item">';
                      echo '<label>Favorito'.$i.':</label><input type="text" value="'.$favorites3[$i][$k].'" id="fav'.$i.'" >';//nombre
                      echo'<br>';
                      echo '<label>url:</label><input type="text" value="'.$favorites3[$i][$j].'" id="linkfav'.$i.'" style="width:90%;">';//url
                    }
                  break;          
                  case 2:
                    echo '<li class="list-group-item">Error de consulta</li>';
                  break;
                  default:
                    echo '<li class="list-group-item">Error. No se pueden cargar los links</li>';
                  break;
                };
              ?>            
            <li class="list-group-item">
              <input type="button"  class="btn btn-primary" onclick="addfavorite();" value="Guardar Favoritos">
              <div id="mensaje_fav"></div>
            </li>
            </form>
          </div>
        </div>    
      </div>

      <div class="col-sm-12 col-md-12">
        <div class="list-group">
          <a href="#" class="list-group-item active">
            -Contraseña WIFI:
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


      <div class="col-sm-12 col-md-12">
        <div class="list-group">
          <a href="#" class="list-group-item active">
            -Control de Comentarios:
          </a>
          <div id="coments">                  
            <li class="list-group-item">
              <input type="button"  class="btn btn-default" onclick="showComents();" value="Editar comentarios">
              <div id="mensaje_coments"></div>
            </li>          
          </div>
        </div>
      </div>




  </div>
  <!-- fin insercion-->

   <!-- insercion2 -->
   <div class="col-sm-6 col-md-8" style="max-height:655px; overflow: auto; position: relative; "> 

<div id="espejo" >
      <div class="col-sm-6 col-md-5">
        <div class="thumbnail">
          <img src="http://192.168.100.45/cyber-system/conten/img/vid1.png" class="prinIma" alt="Inserta Videos">
          <div class="caption">
            <h3>Edición multimedia</h3>
            <p>Aquí puedes editar los post multimedia previamente publicados.</p>
            <p><a href="#" class="btn btn-primary" role="button">Nuevo +</a>
               <a href="#" class="btn btn-default" role="button">Buscar Videos</a>
            </p>
        </div>
      </div>
    </div>


    <div class="col-sm-6 col-md-5">
      <div class="thumbnail">
        <img src="http://192.168.100.45/cyber-system/conten/img/vid1.png" class="prinIma" alt="Inserta Videos">
        <div class="caption">
          <h3>Agrega multimedia</h3>
          <p>Aquí puedes agregar contenido multimedia como videos, imágenes,etc.

          </p>
          <p><a href="#" class="btn btn-primary" role="button">Nuevo video</a>
           <a href="#" class="btn btn-default" role="button">Nueva imágen</a></p>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-5">
      <div class="thumbnail">
        <img src="http://192.168.100.45/cyber-system/conten/img/vid1.png" class="prinIma" alt="Inserta Videos">
        <div class="caption">
          <h3>Agrega un post</h3>
          <p>Aquí puedes agregar contenido en forma de blog.

          </p>
          <p><a href="#" class="btn btn-primary" role="button">Nuevo +</a>
           <a href="#" class="btn btn-default" role="button">Editar entradas</a></p>
        </div>
      </div>
    </div>


    

  

   </div>
  </div>

<!-- fin insercion2-->
</div>



  
</div>