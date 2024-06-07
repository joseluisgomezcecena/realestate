<div class="page-header">
    <h2 class="header-title">Categorias</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Categorias</a>
            <span class="breadcrumb-item active">Indexar</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('categories/create') ?>" class="btn btn-primary">Nueva Categoria</a>
    </div>
</div>
<div class="card mt-5">
    <div class="card-body">

        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <table style="font-size:12px;" id="data-categories" class="table">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo $category['category_name']; ?></td>
                        <td><?php echo date_format(date_create($category['created_at']), "m/d/Y H:i:s"); ?></td>
                        <td><?php echo date_format(date_create($category['updated_at']), "m/d/Y H:i:s"); ?></td>
                        <td>
                            <a href="<?php echo base_url('categories/edit/' . $category['category_id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?php echo base_url('categories/delete/' . $category['category_id']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><a style="font-weight:lighter;" href="#">Lista imprimible</a></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>