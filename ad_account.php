<?php
				include "includes/header.php";
                include "includes/functions.php";

/**
 * Toastr - уведомления
 */
if(isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'success') {
        echo '<script type="text/javascript">toastr.success("Рекламные аккаунты -  ОБНОВЛЕНЫ", "УВЕДОМЛЕНИЕ")</script>';
    } elseif ($status == 'delete') {
        echo '<script type="text/javascript">toastr.error("Аккаунт  -  УДАЛЁН", "УВЕДОМЛЕНИЕ")</script>';
    } elseif ($status == 'update') {
        echo '<script type="text/javascript">toastr.info("Аккаунты - ОБНОВЛЁН", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'reload') {
        echo '<script type="text/javascript">toastr.info("Данные обновлены", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'createPixel_success') {
        echo '<script type="text/javascript">toastr.info("Пиксель создан", "УВЕДОМЛЕНИЕ")</script>';
    }elseif ($status == 'createPixel_error') {
        echo '<script type="text/javascript">toastr.warning("'.$_GET['error'].'", "УВЕДОМЛЕНИЕ")</script>';
    }
}
?>
<script language="JavaScript">
    $(document).ready(function(){
        $("#push").click(function()
        {
            $("#autofill").fadeIn(5000);
            $.ajax(
                {
                    type: "POST",
                    url: "func/ajaxHandler.php", // Адрес обработчика
                    data: $("#autoads").serialize(),
                    error:function()
                    {
                        $("#autofill").html("Произошла ошибка!");
                    },
                    beforeSend: function()
                    {
                        $("#autofill").html("<div class='spinner-border' role='status'><span class='sr-only'>Заливаю...</span></div> ");
                    },
                    success: function(result)
                    {
                        $("#autofill").html(result);
                        checkThis();
                    }
                });
            return false;
        });
    });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div id="autofill"></div>
                    <h1><a class="btn btn-primary" href="func/ajaxHandler.php?reload_ad"> <i class="fas fa-sync-alt"></i> Обновить список кабинетов</a> <button type="button" class="btn btn-primary" data-placement="top" data-tooltip="tooltip" title="Массовый залив (пока не работает)">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fab fa-facebook-f"> </i> Рекламные кабинеты</li>
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
            <h3 class="card-title">Всего кабинетов: <?php echo counting("ad_account", "id");?></h3>

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
			<th>Имя</th>
			<th>Лимит</th>
			<th>Финансы</th>
            <th>Статус</th>

				<th class="not">Action</th>
				</tr>
				</thead>

				<?php
				$ad_account = getAll("ad_account");
				if($ad_account) foreach ($ad_account as $ad_accounts):
					?>
					<tr>
		<td><?php echo $ad_accounts['id']?></td>
                        <td><?php echo $ad_accounts['name']?>
                            <p class="text-muted">РК ID: <?php echo $ad_accounts['adaccount_id']?>
                                <br>Pixel ID: <?php echo $ad_accounts['pixel_id']?></p>
                        </td>
		<td><?php echo $ad_accounts['adtrust_dsl']?></td>
        <td><p class="text-muted">Биллинг: <?php echo $ad_accounts['billing']?> <br>Потрачено: <?php echo $ad_accounts['amount']?></p></td>
        <td><?php echo statusAdAccount($ad_accounts['account_status']); ?> <br><?php echo disable_reason($ad_accounts['disable_reason']); ?></td>


						<td>
                            <button type="button" class="btn btn-primary" data-placement="top" data-tooltip="tooltip" title="Залить РК" data-toggle="modal" data-target="#modal-autofill" data-whatever="<?php echo $ad_accounts['id']?>">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </button>
                            <a class="btn btn-primary dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Действия
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="func/ajaxHandler.php?createPixel=<?php echo $ad_accounts['id']?>">Создать Пиксель</a>

                                <a class="dropdown-item" href="func/ajaxHandler.php?createPixel=<?php echo $ad_accounts['id']?>">Привязать карту</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="save.php?act=delete&id=<?php echo $ad_accounts['id']?>&cat=ad_account">Удалить</a>
                            </div>
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
<div class="modal fade" id="modal-autofill">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Запуск рекламы</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="autoads" action="" enctype='multipart/form-data'>
                    <fieldset>
                        <input name="adaccount_id" id="adaccount_id" type="hidden" value="">


                        <div class="row" id="loadInfo">

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Пресет</label>
                                    <select class="form-control select2" name="preset">
                                        <?php
                                        $preset = getAll("preset");
                                        if($preset) foreach ($preset as $presets):
                                            ?>
                                            <option value="<?php echo $presets['id']?>"><?php echo $presets['name_campaign']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Ссылка</label>
                                    <input type="text" class="form-control" name="link" placeholder="https://site.ru/aOfokwi">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="customFile">Креатив</label>

                                    <select class="form-control select2" name="creative">
                                        <?php
                                        $file = getAll("files");
                                        if($file) foreach ($file as $files):
                                            ?>
                                            <option value="<?php echo $files['id']?>"><?php echo $files['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary" id="push" data-dismiss="modal">Залить</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
					<?php include "includes/footer.php";?>
				