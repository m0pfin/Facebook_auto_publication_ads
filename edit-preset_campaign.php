<?php
				include "includes/header.php";
				$data=[];

				$act = $_GET['act'];
				if($act == "edit"){
					$id = $_GET['id'];
					$preset_campaign = getById("preset_campaign", $id);
				}
				?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="preset.php">Пресеты</a></li>
                        <li class="breadcrumb-item active"><i class="far fa-users"></i> Добавить пресет</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Добавить пресет</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">

				<form method="post" action="save.php" enctype='multipart/form-data'>
					<fieldset>
						<input name="cat" type="hidden" value="preset_campaign">
						<input name="id" type="hidden" value="<?=$id?>">
						<input name="act" type="hidden" value="<?=$act?>">
				
							<label>Name</label>
							<input class="form-control" type="text" name="name" value="<?=$preset_campaign['name']?>" /><br>
							
							<label>Objective</label>
							<input class="form-control" type="text" name="objective" value="<?=$preset_campaign['objective']?>" /><br>
							
							<label>Status</label>
							<input class="form-control" type="text" name="status" value="<?=$preset_campaign['status']?>" /><br>

							<label>Campaign id</label>
							<input class="form-control" type="text" name="campaign_id" value="<?=$preset_campaign['campaign_id']?>" /><br>
							<br>
					<input type="submit" value=" Save " class="btn btn-success">
					</form>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
<!-- general form elements disabled -->
</div>
<!-- /.card-body -->
<div class="card-footer">
    Альфа-тест
</div>
<!-- /.card-footer-->
</div>
<!-- /.card -->
					<?php include "includes/footer.php";?>
				