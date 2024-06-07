<div style="height:89vh" class="row align-items-center w-100">
    <div class="col-md-8 col-lg-4 m-h-auto">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between m-b-30">
                    <!--
                    <img style="width:150px;" class="img-fluid" alt="" src="<?php echo base_url() ?>assets/images/logowide.png">
                    -->
                    <a style="color:black; font-weight:900" class="navbar-brand text-brand" href="<?php echo base_url(); ?>">Bienes<span class="text-success">Raices
                        <!--little house icon-->
                        <sup><span class="anticon anticon-home"></sup>
                        </span>
                    </a>
                    <h2 class="m-b-0"></h2>
                </div>
                <form action="<?php echo base_url('auth/login') ?>" method="post">
                  
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <?php echo validation_errors(); ?>


                    <div class="form-group">
                        <label class="font-weight-semibold" for="userName">Usuario:</label>
                        <input type="text" class="form-control" id="userName" name="username" placeholder="Username">
                    </div>
                   
                    <div class="form-group">
                        <label class="font-weight-semibold" for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                   
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between p-t-15">
                            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        