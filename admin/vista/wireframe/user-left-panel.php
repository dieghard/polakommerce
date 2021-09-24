<div class="user-panel">
              <div class="user-image">
                <a href="../vista/logout.php">
                  <img class="img-circle" src="assets/img/m1.svg" alt="Biblio">
                </a>
              </div>
              <div class="user-info">
                <h5><?php 

                echo $_session_NOMBRE; ?></h5>

                <ul class="nav">
                    <li class="dropdown">
                    <!--<a href="#" class="text-turquoise small dropdown-toggle bg-transparent" data-toggle="dropdown">-->
                      <i class="fa fa-fw fa-circle">
                      </i> <small style="color:greenyellow"> En Linea </small>
                    <!--</a>-->
                        <ul class="dropdown-menu animated flipInY pull-right">
                          <li>
                            <a href="#">Datos</a>
                          </li>
                          <li role="separator" class="divider"></li>
                          <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-sign-out"></i> Salir</a>
                          </li>
                        </ul>
                  </li>
                </ul>
              </div>
</div>
