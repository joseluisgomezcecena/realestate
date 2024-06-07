<div class="page-header">
    <h2 class="header-title">Procesos Del Proyecto</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a href="<?php echo base_url(); ?>projects" class="breadcrumb-item">Proyectos</a>
            <a class="breadcrumb-item" href="<?php echo base_url("projects/update/" . $project['project_id']) ?>"><?php echo $project['project_name'] ?></a>
            <span class="breadcrumb-item active">Agregar Procesos</span>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php } ?>
    </div>
</div>


<div class="container-fluid">
    <div class="row">

    <div class="col-lg-7">
    <div class="card">
        <div class="card-body">
            <h4>Procesos Disponibles</h4>
            <div class="m-t-25">

                <div class="row">
                    <?php foreach ($operations as $operation): ?>
                        <div class="col-lg-4">
                        <div style="box-shadow:none; border:solid gray 1px; border-radius:0" class="card m-b-10 text-center">
                            <div class="card-body">
                                <h6 class=""><?php echo $operation['operation_name']; ?></h6>
                            </div>
                            <div class="card-footer text-center ">
                                <form action="<?php echo base_url("projects/operations/" . $project['project_id']) ?>" method="post">
                                    <input type="hidden" name="operation_id" value="<?php echo $operation['operation_id']; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    <?php endforeach; ?>
                
                </div>
            </div>
        </div>
    </div>
    </div>
    

    <div class="col-lg-5">
    <div class="card">
        <div class="card-body">
            <h4>Procesos De: <b class="text-primary"><?php echo $project['project_name']; ?></b></h4>
            <p>Estos son los procesos que se deberan llenar en la orden de trabajo, <strong>puedes arrastrar los procesos</strong> para cambiar su orden.</p>            
            <div class="m-t-25">

                <ul class="list-group list-group-flush">
                    <?php foreach ($project_ops as $project_op): ?>
                        <li class="list-group-item" id="<?php echo $project_op['po_id']; ?>">
                            <form action="<?php echo base_url("projects/delete_operation/" . $project['project_id'] . "/" . $project_op['po_id']) ?>" method="post">
                                <?php echo $project_op['operation_name']; ?>
                                <button type="submit" class="btn btn-sm btn-danger float-right">Eliminar</a>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class=" mt-5">
                    <a class="btn btn-primary" href="<?php echo base_url("workorders/update/" . $project['project_id']); ?>" >Llenar Orden de Trabajo</a>
                </div>
                

            </div>
        </div>
    </div>
    </div>


    </div>
</div>
