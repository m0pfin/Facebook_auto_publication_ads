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
                    <h1><a class="btn btn-primary" href="edit-users.php?act=add"> <i class="glyphicon glyphicon-plus-sign"></i> Add New User</a></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-user"></i> Пользователи</li>
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
            <h3 class="card-title">Всего пользователей: <?php echo counting("users", "id");?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">


				<table id="sorted" class="table table-bordered table-striped">
				<thead>
				<tr>
							<th>ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Role</th>

				<th class="not">Action</th>
				</tr>
				</thead>

				<?php
				$users = getAll("users");
				if($users) foreach ($users as $userss):
					?>
					<tr>
		<td><?php echo $userss['id']?></td>
		<td><?php echo $userss['name']?></td>
		<td><?php echo $userss['email']?></td>
		<td><?php echo $userss['password']?></td>
		<td><?php echo $userss['role']?></td>


						<td><a href="edit-users.php?act=edit&id=<?php echo $userss['id']?>"><i class="fas fa-user-edit"></i></a> / <a href="save.php?act=delete&id=<?php echo $userss['id']?>&cat=users" onclick="return navConfirm(this.href);"><i class="far fa-trash-alt"></i></a></td>

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
					<?php include "includes/footer.php";?>
				