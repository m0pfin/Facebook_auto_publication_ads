<?php
				include "includes/header.php";
				$data=[];

				$act = $_GET['act'];
				if($act == "edit"){
					$id = $_GET['id'];
					$accounts = getById("accounts", $id);
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
                        <li class="breadcrumb-item"><a href="accounts.php">Аккаунты</a></li>
                        <li class="breadcrumb-item active"><i class="far fa-users"></i> Добавить новый аккаунт</li>
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
            <h3 class="card-title">Добавить новый аккаунт</h3>

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
						<input name="cat" type="hidden" value="accounts">
						<input name="id" type="hidden" value="<?=$id?>">
						<input name="act" type="hidden" value="<?=$act?>">

                        <div class="form-group">
							<label>Название</label>
							<input class="form-control" type="text" name="name" value="<?=$accounts['name']?>" />
                        </div>

                        <div class="form-group">
							<label>access_token</label>
							<textarea class="ckeditor form-control" name="token"><?=$accounts['token']?></textarea>
                        </div>
							
							<!--label>Дневной лимит</label-->
							<input class="form-control" type="hidden" name="adtrust_dsl" value="0" />

                        <div class="form-group">
                            <label>Прокси</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="proxy">
                                <?php
                                $getProxy = $db->fetch("SELECT * FROM proxy WHERE id='".$accounts['proxy_id']."'");
                                ?>
                                <option value="<?php echo $getProxy['id']?>" selected><?php echo $getProxy['ip']?>:<?php echo $getProxy['port']?>:<?php echo $getProxy['login']?>:<?php echo $getProxy['pass']?></option>
                                <?php
                                $proxy = getAll("proxy");
                                if($proxy) foreach ($proxy as $proxys):
                                    ?>
                                    <option value="<?php echo $proxys['id']?>"><?php echo $proxys['ip']?>:<?php echo $proxys['port']?>:<?php echo $proxys['login']?>:<?php echo $proxys['pass']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

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
				