<?php
include "includes/header.php";
include "includes/functions.php";

/**
 * Toastr - уведомления
 */
if(isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'success') {
        echo '<script type="text/javascript">toastr.success("Аккаунт ' . $_GET['name'] . ' -  ДОБАВЛЕН", "УВЕДОМЛЕНИЕ")</script>';
    } elseif ($status == 'delete') {
        echo '<script type="text/javascript">toastr.error("Аккаунт ID ' . $_GET['name'] . ' -  УДАЛЁН", "УВЕДОМЛЕНИЕ")</script>';
    } elseif ($status == 'update') {
        echo '<script type="text/javascript">toastr.info("Аккаунт ' . $_GET['name'] . ' - ОБНОВЛЁН", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'warning') {
        echo '<script type="text/javascript">toastr.warning("Ошибка! ' . $_GET['name'] . '", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'reload') {
        echo '<script type="text/javascript">toastr.info("Данные обновлены", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'page_create_success') {
        echo '<script type="text/javascript">toastr.info("ФП создана!", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'page_create_canceled') {
        echo '<script type="text/javascript">toastr.warning("Ошибка создания ФП", "УВЕДОМЛЕНИЕ")</script>';
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
                    <h1><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Добавить аккаунт
                        </button>       <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Обновить статусы аккаунтов" onclick="window.location.href='func/ajaxHandler.php?reload_social'">
                            <i class="fas fa-sync-alt"></i>
                        </button></h1>
                    <!--a class="btn btn-primary" href="edit-accounts.php?act=add"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Accounts</a-->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="far fa-users"> </i> Accounts</li>
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
            <h3 class="card-title">Всего аккаунтов <?php echo counting("accounts", "id");?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">


				<table id="sorted" class="table table-hover">
				<thead>
				<tr>
			<th>ID</th>
			<th>Название</th>
			<th>Заметка</th>
            <th>Статус</th>

				<th class="not">Action</th>
				</tr>
				</thead>
                    <tbody>
				<?php
				$accounts = getAll("accounts");
				if($accounts) foreach ($accounts as $accountss):
					?>
					<tr>
		<td><?php echo $accountss['id']?></td>
        <td><?php echo $accountss['name']?> <br> <?php echo ($accountss['pages'] == 0) ? '<i class="far fa-file"  data-toggle="tooltip" data-placement="top" title="ФП не создана"></i>' : '<i class="fas fa-file"  data-toggle="tooltip" data-placement="top" title="ФП есть"></i>'; ?> <?php if($accountss['user_id'] !=0) { ?><span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Имя и ID соц.аккаунта"><?php echo $accountss['user_name']?> (<?php echo $accountss['user_id']?>)</span><?php } ?></td>
		<td><?php echo $accountss['pages']?></td>
        <td><?php echo statusSocial($accountss['status']);?></td>


						<td>
                                <a class="btn btn-primary dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Действия
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="edit-accounts.php?act=edit&id=<?php echo $accountss['id']?>">Редактировать</a>
                                    <a class="dropdown-item" href="save.php?act=delete&id=<?php echo $accountss['id']?>&cat=accounts">Удалить</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="func/ajaxHandler.php?createFanpage=<?php echo $accountss['id']?>">Создать ФП</a>
                                    <a class="dropdown-item" href="#">Создать БМ</a>
                                </div>

                            </tr>
					<?php endforeach; ?>
                    </tbody>
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
                <h4 class="modal-title">Добавить аккаунт</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="save.php" enctype='multipart/form-data'>
                    <fieldset>
                        <input name="cat" type="hidden" value="accounts">
                        <input name="id" type="hidden" value="<?=$id?>">
                        <input name="act" type="hidden" value="add">
                        <!--label>Дневной лимит</label-->
                        <input type="hidden" name="adtrust_dsl" value="0" />

                        <div class="form-group">
                        <label>Название</label>
                        <input class="form-control" type="text" name="name" value="" />
                        </div>


                        <div class="form-group">
                        <label>Токен</label>
                        <textarea class="ckeditor form-control" name="token"></textarea>
                        </div>


                                <div class="form-group">
                                    <label>Прокси</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="proxy">
                                        <?php
                                        $proxy = getAll("proxy");
                                        if($proxy) foreach ($proxy as $proxys):
                                        ?>
                                        <option value="<?php echo $proxys['id']?>"><?php echo $proxys['ip']?>:<?php echo $proxys['port']?>:<?php echo $proxys['login']?>:<?php echo $proxys['pass']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

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
				