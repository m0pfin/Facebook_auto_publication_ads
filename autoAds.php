<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 30.06.2020
 * Time: 05:53
 */
include "includes/header.php";
include "includes/functions.php";
?>

<!-- Запрос Рекламного аккаунта и ФП -->
<script language="JavaScript">
    $(document).ready(function(){
        $(document).on('change', '#account', function() {
            $("#loadInfo").fadeIn(5000);
            $.ajax(
                {
                    type: "POST",
                    url: "func/ajaxHandler.php", // Адрес обработчика
                    data: $("#callbacks").serialize(),
                    error:function()
                    {
                        $("#loadInfo").html("Произошла ошибка!");
                    },
                    beforeSend: function()
                    {
                        $("#loadInfo").html("<div class='spinner-border' role='status'><span class='sr-only'>Loading...</span></div>");
                    },
                    success: function(result)
                    {
                        $("#loadInfo").html(result);
                        checkThis();
                    }
                });
            return false;
        });
    });
</script>

<!-- Запрос пикселя Facebook -->
<script language="JavaScript">
    $(document).ready(function(){
        $(document).on('change', '#account_id', function() {
            $("#pixel_id").fadeIn(5000);
            $.ajax(
                {
                    type: "POST",
                    url: "func/ajaxHandler.php", // Адрес обработчика
                    data: $("#callbacks").serialize(),
                    error:function()
                    {
                        $("#pixel_id").html("Произошла ошибка!");
                    },
                    beforeSend: function()
                    {
                        $("#pixel_id").html("<div class='spinner-border' role='status'><span class='sr-only'>Loading...</span></div>");
                    },
                    success: function(result)
                    {
                        $("#pixel_id").html(result);
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
                    <h1>Автозалив 0.1</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Автозалив 0.1</li>
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
                <h3 class="card-title">Автозалив</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <!-- right column -->
                <div class="col-md">
                    <!-- general form elements disabled -->

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div role="form">
                                <form action="" id="callbacks">

                                <!-- select -->
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label>Аккаунт</label>
                                            <select class="form-control select2" id="account" name="account">
                                             <?php
                                              $accounts = $db->query("SELECT * FROM accounts WHERE status='0'");
                                              if($accounts) foreach ($accounts as $accountss):
                                              ?>
                                                <option value="<?php echo $accountss['id']?>"><?php echo $accountss['name'] . ' (' . statusSocial($accountss['status']) . ')'; ?></option>
                                             <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Пресет</label>
                                            <select class="form-control select2">
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
                                <!-- select end -->

                                    <div class="row" id="loadInfo">

                                        <div class="col-sm-6">
                                            <div class="form-group" id="adAccId">
                                                <label>Рекламный аккаунт</label>
                                                <select class="form-control select2" id="account_id" name="account_id">
                                                    <option value="">Выберите соц.аккаунт</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group"  id="page_id">
                                                <label>Страница ФП</label>
                                                <select class="form-control select2">
                                                    <option value="">Выберите соц.аккаунт</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group" id="pixel_id">
                                            <label>Facebook Pixel</label>
                                            <select class="form-control select2">
                                                <option value="">Выберите рекламный аккаунт</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Карта</label>
                                            <select class="form-control select2">
                                                <?php
                                                $cards = getAll("cards");
                                                if($cards) foreach ($cards as $cardss):
                                                    ?>
                                                    <option value="<?php echo $cardss['id']?>"><?php echo $cardss['cardNumber']?></option>
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
                                                <input type="text" class="form-control" placeholder="https://site.ru/aOfokwi">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="customFile">Креатив</label>

                                                <select class="form-control select2">
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

                                <!-- input states -->
                                    <button type="submit" class="btn btn-primary">Залить</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- general form elements disabled -->

                    <!-- /.card-body -->
                    <div class="card-footer">
                        Альфа-тест
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include "includes/footer.php";?>
