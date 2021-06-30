<?php
				include "includes/header.php";
				$data=[];

				$act = $_GET['act'];
				if($act == "edit"){
					$id = $_GET['id'];
					$ad_account = getById("ad_account", $id);
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
                        <li class="breadcrumb-item"><a href="ad_account.php">Рекламные ккаунты</a></li>
                        <li class="breadcrumb-item active"><i class="far fa-users"></i> Добавить рекламный аккаунт</li>
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
                <h3 class="card-title">Добавить рекламный аккаунт</h3>

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
						<input name="cat" type="hidden" value="ad_account">
						<input name="id" type="hidden" value="<?=$id?>">
						<input name="act" type="hidden" value="<?=$act?>">
				
							<label>Accounts id</label>
							<input class="form-control" type="text" name="accounts_id" value="<?=$ad_account['accounts_id']?>" /><br>
							
							<label>Name</label>
							<input class="form-control" type="text" name="name" value="<?=$ad_account['name']?>" /><br>
							
							<label>Pixel id</label>
							<input class="form-control" type="text" name="pixel_id" value="<?=$ad_account['pixel_id']?>" /><br>
							
							<label>Adtrust dsl</label>
							<input class="form-control" type="text" name="adtrust_dsl" value="<?=$ad_account['adtrust_dsl']?>" /><br>
							
							<label>Billing</label>
							<input class="form-control" type="text" name="billing" value="<?=$ad_account['billing']?>" /><br>
							
							<label>Amount</label>
							<input class="form-control" type="text" name="amount" value="<?=$ad_account['amount']?>" /><br>
							
							<label>Adaccount id</label>
							<input class="form-control" type="text" name="adaccount_id" value="<?=$ad_account['adaccount_id']?>" /><br>
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
				