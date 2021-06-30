<?php
		include "includes/header.php";
		?>
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
                        <li class="breadcrumb-item active">Dashboard</li>
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
            <h3 class="card-title">Dashdoard</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">

		<table class="table table-striped">
		<tr>
		<th class="not">Table</th>
		<th class="not">Entries</th>
		</tr>
		
				<tr>
					<td><a href="accounts.php">Accounts</a></td>
					<td><?=counting("accounts", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="ad_account.php">Ad_account</a></td>
					<td><?=counting("ad_account", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="cards.php">Cards</a></td>
					<td><?=counting("cards", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="preset_ads.php">Preset_ads</a></td>
					<td><?=counting("preset_ads", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="preset_adset.php">Preset_adset</a></td>
					<td><?=counting("preset_adset", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="preset.php">Preset_campaign</a></td>
					<td><?=counting("preset_campaign", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="proxy.php">Proxy</a></td>
					<td><?=counting("proxy", "id")?></td>
				</tr>
				
				<tr>
					<td><a href="users.php">Users</a></td>
					<td><?=counting("users", "id")?></td>
				</tr>
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
			<?php include "includes/footer.php";?>
			