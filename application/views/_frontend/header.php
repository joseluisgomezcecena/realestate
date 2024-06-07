<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assets/frontend/css/style.css" rel="stylesheet">

  <!-- =======================================================
  Jose Luis Gomez Ceceña.
  ======================================================== -->
</head>

<body>

  <!-- ======= Property Search Section ======= -->
  <div class="click-closed"></div>
  <!--/ Form Search Star /-->
  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Busca Propiedades</h3>
    </div>
    <span class="close-box-collapse right-boxed bi bi-x"></span>
    <div class="box-collapse-wrap form">
      <form class="form-a">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              <label class="pb-2" for="Type">Palabra clave</label>
              <input type="text" class="form-control form-control-lg form-control-a" placeholder="Palabra clave">
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="Type">Transacción</label>
              <select class="form-control form-select form-control-a" id="Type">
                <option value="">Todas</option>
                
                <option value="r">Renta</option>
                <option value="v">Venta</option>
                <option value="t">Traspaso</option>
              
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="city">Ciudad</label>
              <input list="cities" class="form-control form-select form-control-a" id="city">
              <datalist id="cities">
                <option value="Todas">
                <?php foreach ($cities as $city) : ?>
                  <option value="<?php echo $city['nombre']; ?>">
                <?php endforeach; ?>
                <!-- Add more cities here -->
              </datalist>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bedrooms">Recamaras</label>
              <select class="form-control form-select form-control-a" id="bedrooms">
                <option>Any</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                  <option><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="garages">Garages</label>
              <select class="form-control form-select form-control-a" id="garages">
                <option>Any</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                  <option><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="bathrooms">Baños</label>
              <select class="form-control form-select form-control-a" id="bathrooms">
                <option>Any</option>
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                  <option><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group mt-3">
              <label class="pb-2" for="price">Precio</label>
              <select class="form-control form-select form-control-a" id="price">
                <option>Sin limites</option>
                <option>$50,000</option>
                <option>$100,000</option>
                <option>$150,000</option>
                <option>$200,000</option>
                <option>$500,000</option>
                <option>1,000,000</option>
                <option>2,000,000</option>
                <option>5,000,000</option>
                <option>10,000,000</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-b">Buscar Propiedad</button>
          </div>
        </div>
      </form>
    </div>
  </div><!-- End Property Search Section -->>
