<?php require_once INCLUDES.'inc_header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <?php echo Flasher::flash(); ?>
    </div>

    <!-- formulario -->
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h4><?php echo $d->title; ?></h4>
        </div>
        <div class="card-body">
          <form action="creator/post_controller" method="post" novalidate>
            <?php echo insert_inputs(); ?>
            
            <div class="mb-3">
              <label for="filename">Nombre del controlador (sin "Controller.php")</label>
              <input type="text" class="form-control" id="filename" name="filename" placeholder="reports" required>
            </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Crear ahora</button>
          </form>
        </div>
        <div class="card-footer">
          <a class="btn btn-success" href="<?php echo 'creator/model' ?>">Nuevo modelo</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once INCLUDES.'inc_footer_v2.php'; ?>

