<?php
				include "includes/header.php";
/**
 * Toastr - уведомления
 */

if(isset($_GET['status'])){
    $status = $_GET['status'];
    if($status == 'success'){
        echo '<script type="text/javascript">toastr.success("Прокси '.$_GET['name'].' -  ДОБАВЛЕНА", "УВЕДОМЛЕНИЕ")</script>';
    }elseif($status == 'delete'){
        echo '<script type="text/javascript">toastr.error("Прокси ID '.$_GET['name'].' -  УДАЛЁНА", "УВЕДОМЛЕНИЕ")</script>';
    }
    elseif($status == 'update'){
        echo '<script type="text/javascript">toastr.info("Прокси '.$_GET['name'].' - ОБНОВЛЁНА", "УВЕДОМЛЕНИЕ")</script>';
    }
}
				?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Добавить прокси
                        </button>
                        <!--a class="btn btn-primary" href="edit-proxy.php?act=add"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Proxy</a--></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="far fa-wifi"></i> Proxy</li>
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
            <h3 class="card-title">Всего прокси: <?php echo counting("proxy", "id");?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">


				<table id="sorted" class="table table-hover table-bordered">
				<thead>
				<tr>
							<th>ID</th>
			<th>IP</th>
			<th>Port</th>
			<th>Login</th>
			<th>Pass</th>

				<th class="not">Action</th>
				</tr>
				</thead>

				<?php
				$proxy = getAll("proxy");
				if($proxy) foreach ($proxy as $proxys):
					?>
					<tr>
		<td><?php echo $proxys['id']?></td>
		<td><?php echo $proxys['ip']?></td>
		<td><?php echo $proxys['port']?></td>
		<td><?php echo $proxys['login']?></td>
		<td><?php echo $proxys['pass']?></td>


						<td><a href="edit-proxy.php?act=edit&id=<?php echo $proxys['id']?>"><i class="fas fa-edit"></i></a> <a href="save.php?act=delete&id=<?php echo $proxys['id']?>&cat=proxy" onclick="return navConfirm(this.href);"><i class="far fa-trash-alt"></i></a></td>
						</tr>
					<?php endforeach; ?>
					</table>

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

<!-- /.modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавить прокси</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="save.php" enctype='multipart/form-data'>
                    <fieldset>
                        <input name="cat" type="hidden" value="proxy">
                        <input name="id" type="hidden" value="<?=$id?>">
                        <input name="act" type="hidden" value="add">

                        <!-- select -->
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>IP</label>
                                    <input type="text" class="form-control" placeholder="192.168.0.1" name="ip" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PORT</label>
                                    <input type="text" class="form-control" placeholder="5010" name="port" value="">
                                </div>
                            </div>
                        </div>
                        <!-- end select -->

                        <!-- select -->
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" class="form-control" placeholder="proxy_login" name="login" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" placeholder="proxy_pass" name="pass" value="">
                                </div>
                            </div>
                        </div>
                        <!-- end select -->



            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
					<?php include "includes/footer.php";?>
				