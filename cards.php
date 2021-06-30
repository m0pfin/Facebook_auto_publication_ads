<?php
				include "includes/header.php";

/**
 * Toastr - уведомления
 */
				if(isset($_GET['status'])){
                    $status = $_GET['status'];
                    if($status == 'success'){
                        echo '<script type="text/javascript">toastr.success("Карта '.$_GET['name'].' -  ДОБАВЛЕНА", "УВЕДОМЛЕНИЕ")</script>';
                    }elseif($status == 'delete'){
                        echo '<script type="text/javascript">toastr.error("Карта ID '.$_GET['name'].' -  УДАЛЁНА", "УВЕДОМЛЕНИЕ")</script>';
                    }
                    elseif($status == 'update'){
                        echo '<script type="text/javascript">toastr.info("Карта '.$_GET['name'].' - ОБНОВЛЁНА", "УВЕДОМЛЕНИЕ")</script>';
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
                            Добавить карту
                        </button>
                        <!--a class="btn btn-primary" href="edit-cards.php?act=add"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Cards</a--></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-credit-card"> </i> Cards</li>
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
            <h3 class="card-title">Всего карт: <?php echo counting("cards", "id");?></h3>

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
							<th>Id</th>
			<th>Номер карты</th>
			<th>Месяц</th>
			<th>Год</th>
			<th>Cvv</th>

				<th class="not">Action</th>
				</tr>
				</thead>

				<?php
				$cards = getAll("cards");
				if($cards) foreach ($cards as $cardss):
					?>
					<tr>
		<td><?php echo $cardss['id']?></td>
        <td><span class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="Кол-во привязок"><?php echo $cardss['count']?></span>  <?php echo $cardss['cardNumber']?></td>
		<td><?php echo $cardss['moth']?></td>
		<td><?php echo $cardss['year']?></td>
		<td><?php echo $cardss['cvv']?></td>


						<td><a href="edit-cards.php?act=edit&id=<?php echo $cardss['id']?>"><i class="fas fa-edit"></i></a>  <a href="save.php?act=delete&id=<?php echo $cardss['id']?>&cat=cards" onclick="return navConfirm(this.href);"><i class="far fa-trash-alt"></i></a></td>
						</tr>
					<?php endforeach; ?>
					</table>



<!-- /.modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавить карту</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="save.php" enctype='multipart/form-data'>
                    <fieldset>
                        <input name="cat" type="hidden" value="cards">
                        <input name="id" type="hidden" value="<?=$id?>">
                        <input name="act" type="hidden" value="add">

                        <!-- select -->
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Номер карты</label>
                                    <input type="text" class="form-control" placeholder="0000 0000 0000 0000" name="cardNumber" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CVV</label>
                                    <input type="password" class="form-control" placeholder="***" name="cvv" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Месяц</label>
                                    <input type="text" class="form-control" placeholder="MM" name="moth" value="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Год</label>
                                    <input type="text" class="form-control" placeholder="YYYY" name="year" value="">
                                </div>
                            </div>
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
				