<?php
				include "includes/header.php";
				$data=[];

				$act = $_GET['act'];
				if($act == "edit"){
					$id = $_GET['id'];
					$proxy = getById("proxy", $id);
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
                        <li class="breadcrumb-item"><a href="proxy.php">Прокси</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-credit-card"></i> Добавить прокси</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Добавить прокси</h3>

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
						<input name="cat" type="hidden" value="proxy">
						<input name="id" type="hidden" value="<?=$id?>">
						<input name="act" type="hidden" value="<?=$act?>">

                        <!-- select -->
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>IP</label>
                                    <input type="text" class="form-control" placeholder="192.168.0.1" name="ip" value="<?=$proxy['ip']?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PORT</label>
                                    <input type="text" class="form-control" placeholder="5010" name="port" value="<?=$proxy['port']?>">
                                </div>
                            </div>
                        </div>
                        <!-- end select -->

                        <!-- select -->
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" class="form-control" placeholder="proxy_login" name="login" value="<?=$proxy['login']?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" placeholder="proxy_pass" name="pass" value="<?=$proxy['pass']?>">
                                </div>
                            </div>
                        </div>
                        <!-- end select -->

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
				