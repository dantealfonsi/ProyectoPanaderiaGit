<!--Start User Profile-->        

<style>

    input{
        font-size: 1.4rem;
        padding: 0.6rem;
        font-family: 'roboto';
        border-radius: .3rem;
        border-bottom: 2px solid #ffd1d1;
        border-top: none;
        border-left: none;
        border-right: none;
        color: #555555;
        width: 18rem;
        background: #e5e5e5;
        text-transform: capitalize;
    }

    .input-group-addon{
        background: linear-gradient(45deg, #fb74a0, #ff2881);
    }


    textarea{
        color: #313131;
        background: #f3f3f3;
        border: dotted pink;
        width: -webkit-fill-available;
        height: 6rem;
        font-size: 1.4rem;
        font-family: 'Roboto';
    }

        .button-rounded-1{
    background: #D12B69;
    color: white;
    padding: 0.5rem 2.5rem;
    border-radius: 3rem;
    font-family: 'button';
    border: none;
    font-size: 1rem;
    }


    .button-rounded-1:hover{
    background: #ff68a0;
    transition: ease .4s;
    cursor: pointer;
    }

    .button-rounded-2{
    background: none;
    color: #D12B69;
    padding: 0.5rem 2.5rem;
    border-radius: 3rem;
    font-family: 'button';
    border: 1px solid #D12B69;
    font-size: 1rem;
    
    }

    .button-rounded-2:hover{
    background: #D12B69;
    color: white;
    padding: 0.5rem 2.5rem;
    border-radius: 3rem;
    font-family: 'button';
    border: none;
    font-size: 1rem;
    transition: ease .4s;
    cursor: pointer;
    }


    
    @font-face {
      font-family: button;
      src: url(../../css/button.ttf) format('truetype');
     }
        
</style>


<div class="container user-profile-container">
    <div class="row">
        <div id="screenRes" class="col-md-15">
            <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
                    <!-- Form Name -->
                    <div class="form-spacer">
                        <br>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Username ">Nombre Usuario </label>  
                        <div class="col-md-1">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fas fa-check"></i>
                                </div> 
                                <input value = "<?php echo $nombreUsuario;?>" disabled style='width: 33.33333333%;'>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <span class="input-error"><?php echo $fnameCriteria;?></span>
                        <label class="col-md-4 control-label" for="First Name">Nombre</label>  
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input value = "<?php echo $nombre;?>" id="First Name" name="fname" type="text" placeholder="Nombre" >
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <span class="input-error"><?php echo $lnameCriteria;?></span>
                        <label class="col-md-4 control-label" for="Last Name ">Apellido </label>  
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input value = "<?php echo $apellido;?>" id="Last Name " name="lname" type="text" placeholder="Last Name ">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <span class="input-error"><?php echo $addressCriteria;?></span>
                        <label class="col-md-4 control-label" for="Address ">Direccion </label>  
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <input value = "<?php echo $direccion;?>" id="Address " name="address" type="text" placeholder="Dirección">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="input-error"><?php echo $phoneCriteria;?></span>
                        <label class="col-md-4 control-label" for="Phone Number ">Telefono </label>  
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i> 
                                </div>
                                <input value = "<?php echo $telefono;?>" id="Phone Number " name="phone" type="text" placeholder="Numero de Telefono">
                            </div>
                        </div>
                    </div>


                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Email Address">Correo</label>  
                        <div class="col-md-1">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input value="<?php echo $correo;?>" disabled>
                            </div>
                        </div>
                    </div>


                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="Overview (max 200 words)">Biografia</label>
                        <div class="col-md-4">                     
                            <textarea rows="10"  id="Overview (max 200 words)" name="description" placeholder="Maximo 200 Palabras"><?php echo $descripcion;?></textarea>
                        </div>
                    </div>

                        
                    <div class="form-group">
                        <label class="col-md-4 control-label" ></label>  
                        <div class="col-md-4" style='display: flex;'>
                            <button name="updateProfile" class="button-rounded-1" style='display:flex;'><span class="glyphicon glyphicon-thumbs-up"></span> Actualizar</button>
                            <button name="revertProfile" class="button-rounded-2" style='display:flex;' value=""><span class="glyphicon glyphicon-repeat"></span> Revertir</button>
                            <span class="message"><?php echo "&nbsp&nbsp <b>$updateMessage</b>";?></span>
                        </div> 
                    </div>

                    <!-- Text input-->
                    <br>
                    <hr>
                    <div class="change-password-container">
                        <div class="change-password-subtitle">
                            <h3 style="text-align: center;font-family: 'button';color: black;">Actualizar Contraseña</h3>
                            <p><i class="fas fa-exclamation-triangle"></i>&nbsp&nbsp Tendras que loguearte de nuevo para que tu contraseña se actualice.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="input-error"><?php echo $currentPasswordCriteria;?></span>
                        <label class="col-md-4 control-label" for="Current Password ">Contraseña Actual </label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fas fa-unlock-alt"></i>
                                </div>
                                <input type="password" id="Current Password " name="currentPassword" type="text" placeholder="Ingresa la contraseña actual" >
                            </div>
                        </div>
                    </div>

                
                    <!-- Text input-->
                    <div class="form-group">
                    <span class="input-error"><?php echo $newPasswordCriteria;?></span>
                        <label class="col-md-4 control-label" for="New Password ">Nueva Contraseña</label>  
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <input type="password" id="New Password " name="newPassword" type="text" placeholder="Introducir nueva contraseña ">
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                    <span class="input-error"><?php echo $confirmPasswordCriteria;?></span>
                        <label class="col-md-4 control-label" for="Confirm Password ">Confirmar </label>  
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <input type="password" id="Confirm Password " name="confirmPassword" type="text" placeholder="Confirmar contraseña" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" style='display: flex;align-items: center;'></label>  
                        <div class="col-md-4" style='display: flex;'>
                            <button name="updatePassword" class="button-rounded-1" style='display: flex;align-items: center;gap:.5rem;'><span class="glyphicon glyphicon-thumbs-up"></span> Actualizar</button>
                            <button name="clearPassword" class="button-rounded-2" style='display: flex;align-items: center;gap:.5rem;'><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
                            <span class=message"><?php echo "&nbsp&nbsp <b>$passwordMessage</b>";?></span>
                        </div>
                    </div>

                    <br>
                    <hr>

                   <!-- <div class="danger-zone">
                        <div class="danger-zone-inside">
                            <div class="change-password-container">
                                <div class="change-password-subtitle">
                                    <h3>Borrar Mi Cuenta</h3>
                                    <p><i class="fas fa-exclamation-triangle"></i>&nbsp&nbspAdvertencia: Tu contraseña sera <b>BORRADA</b>. Estate seguro.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="input-error"><?php echo $delPasswordCriteria;?></span>
                                <label class="col-md-4 control-label" for="Current Password ">Contraseña </label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-unlock-alt"></i>
                                        </div>
                                        <input type="password" id="Current Password " name="delPassword" type="text" placeholder="Confirma tu contraseña" class="form-control input-md">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" ></label>  
                                <div class="col-md-4">
                                    <button name="deleteAccount" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Borrar Cuenta</button>
                                    <span class="message"><?php echo "&nbsp&nbsp <b>$passwordMessage</b>";?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                </fieldset>
            </form>
        </div> 
    </div>
</div>

<div class="form-spacer">
    <br><br><br><br><br>
</div>
<!-- End User Profile -->