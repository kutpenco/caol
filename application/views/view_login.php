<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

<?php if ($error_login && $error_login != ""):?>
<div class="login-panel alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<?=$error_login;?>
</div>
<?php endif;?>

            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Inicio de sessão</h3>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url('login/auth/');?>" method="post" id="frmLogin" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuário" id="inputUser" name="inputUser" type="text" autofocus autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Senha" id="inputPassword" name="inputPassword" type="password" value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>