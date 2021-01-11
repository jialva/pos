<div class="login_box">            
    <form method="post" id="login_form" onsubmit="return false">
        <div class="top_b">Inicie sesión para continuar</div> 
        <div class="cnt_b">
            <div class="formRow">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span><input type="text" id="usuario" name="usuario"  autocomplete="off" placeholder="Usuario" />
                </div>
            </div>
            <div class="formRow">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Password" />
                </div>
            </div>
        </div>
        <div class="btm_b clearfix">
            <button class="btn btn-inverse pull-right" type="submit" onclick="ingresar()">Ingresar</button>
            <span class="link_reg"><a href="#pass_form">Olvidó su contraseña?</a></span>
        </div>  
    </form>
    
    <form action="http://magex9.github.io/web/xhub/dashboard.html" method="post" id="pass_form" style="display:none">
        <div class="top_b">No puedes iniciar?</div>    
            <div class="alert alert-info alert-login">
            Por favor, introduzca su dirección de correo electrónico. Recibirás un enlace para crear una nueva contraseña por correo electrónico.
        </div>
        <div class="cnt_b">
            <div class="formRow clearfix">
                <div class="input-prepend">
                    <span class="add-on">@</span><input type="text" placeholder="Tu correo electrónico" />
                </div>
            </div>
        </div>
        <div class="btm_b tac">
            <button class="btn btn-inverse" type="submit">Solicitar Contraseña</button>
        </div>  
    </form>
    <div class="links_b links_btm clearfix">
        <span class="linkform" style="display:none">No importa, <a href="#login_form">envíame de vuelta al inicio de sesión</a></span>
    </div>
    
    <div class="links_b links_btm clearfix">
        <span class="linkform" style="color: #4FB2E0;">SIINCOWEB, POS</span>
    </div>
</div>