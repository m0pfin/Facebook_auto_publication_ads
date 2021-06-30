<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

				include "includes/header.php";
                include "includes/functions.php";
				?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Добавить пресет
                        </button>
                        <!--a class="btn btn-primary" href="edit-preset_campaign.php?act=add"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Preset</a--></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-th"></i> Presets</li>
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
            <h3 class="card-title">Всего пресетов: <?php echo counting("preset", "id");?></h3>

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
			<th>Название</th>
			<th>География</th>
			<th>Плейсмент</th>
			<th>Пол / Возраст</th>
            <th>Устройства</th>

				<th class="not">Action</th>
				</tr>
				</thead>

				<?php
                $preset = getAll("preset");
				if($preset) foreach ($preset as $presets):
					?>
					<tr>
                        <td><?php echo $presets['id']?></td>
		                <td><span class="badge badge-primary"><?php echo objective_h($presets['objective']); ?></span> <?php echo $presets['name_campaign']?></td>
                        <td><span class="badge badge-primary"><?php echo countrys($presets['targeting_geo_countries']);?></span></td>
                        <td><span class="badge badge-primary"><?php echo publisher_platforms($presets['publisher_platforms']); ?></span></td>
                        <td><?php echo gender_h($presets['gender']); ?> <span class="badge badge-primary"><?php echo $presets['age_min']?></span> <span class="badge badge-primary"><?php echo $presets['age_max']?></span></td>
                        <td><span class="badge badge-primary"><?php echo device_platforms_h($presets['device_platforms']);?></span></td>


                        <td><a href="edit-preset_campaign.php?act=edit&id=<?php echo $presets['id']?>"><i class="fas fa-edit"></i></a>  <a href="save.php?act=delete&id=<?php echo $presets['id']?>&cat=preset" onclick="return navConfirm(this.href);"><i class="far fa-trash-alt"></i></a></td>

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
                <h4 class="modal-title">Добавить пресет</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="save.php" enctype='multipart/form-data'>
                    <input name="cat" type="hidden" value="preset">
                    <input name="id" type="hidden" value="<?=$id?>">
                    <input name="act" type="hidden" value="add">

                        <!-- select -->


                                <blockquote>Кампания</blockquote>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Название Campaign</label>
                                            <input class="form-control" type="text" name="name_campaign" value="" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control select2bs4" name="status_campaign" style="width: 100%;">
                                                <option value="0">PAUSED</option>
                                                <option value="1">ACTIVE</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Стратегия</label>
                                            <select class="form-control select2bs4" name="objective" style="width: 100%;">
                                                <option value="0">Конверсии</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <blockquote>Группа объявлений</blockquote>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Название AdSet</label>
                                            <input class="form-control" type="text" name="name_adset" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Дневной бюджет</label>
                                            <input class="form-control" type="text" name="daily_budget_adset" value="" />
                                        </div>
                                    </div>
                                </div>

                                <!--div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Дата запуска</label-->
                                            <input class="form-control" type="hidden" name="start_time" value="2020-04-17T22:23:07-0700" />
                                        <!--/div>
                                    </div-->

                                    <!--div class="col-sm">
                                        <div class="form-group">
                                            <label>Дата остановки</label-->
                                            <input class="form-control" type="hidden" name="end_time" value="0" />
                                        <!--/div>
                                    </div>
                                </div-->


                                        <div class="form-group">
                                            <!--label>Bid strategy</label-->
                                            <input class="form-control" type="hidden" name="bid_strategy" value="0" />
                                        </div>


                                <div class="row">

                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="billing_event" value="0" />
                                        </div>


                                        <div class="col-sm">
                                            <div class="form-group">
                                            <label>Оптимизация и показ</label>
                                                <select class="form-control select2bs4" name="optimization_goal" style="width: 100%;">
                                                    <option value="0">Конверсии на сайте</option>
                                                </select>
                                        </div>
                                    </div>


                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label>Событие</label>
                                                <select class="form-control select2bs4" name="custom_event_type" style="width: 100%;">
                                                    <option value="0">Лид</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Страна</label>
                                            <select class="form-control select2bs4" name="targeting_geo_countries" style="width: 100%;">
                                                <option value="AU">Австралия</option>
                                                <option value="AT">Австрия</option>
                                                <option value="AZ">Азербайджан</option>
                                                <option value="AX">Аландские о-ва</option>
                                                <option value="AL">Албания</option>
                                                <option value="DZ">Алжир</option>
                                                <option value="AS">Американское Самоа</option>
                                                <option value="AI">Ангилья</option>
                                                <option value="AO">Ангола</option>
                                                <option value="AD">Андорра</option>
                                                <option value="AQ">Антарктида</option>
                                                <option value="AG">Антигуа и Барбуда</option>
                                                <option value="AR">Аргентина</option>
                                                <option value="AM">Армения</option>
                                                <option value="AW">Аруба</option>
                                                <option value="AF">Афганистан</option>
                                                <option value="BS">Багамы</option>
                                                <option value="BD">Бангладеш</option>
                                                <option value="BB">Барбадос</option>
                                                <option value="BH">Бахрейн</option>
                                                <option value="BY">Беларусь</option>
                                                <option value="BZ">Белиз</option>
                                                <option value="BE">Бельгия</option>
                                                <option value="BJ">Бенин</option>
                                                <option value="BM">Бермудские о-ва</option>
                                                <option value="BG">Болгария</option>
                                                <option value="BO">Боливия</option>
                                                <option value="BQ">Бонэйр, Синт-Эстатиус и Саба</option>
                                                <option value="BA">Босния и Герцеговина</option>
                                                <option value="BW">Ботсвана</option>
                                                <option value="BR">Бразилия</option>
                                                <option value="IO">Британская территория в Индийском океане</option>
                                                <option value="BN">Бруней-Даруссалам</option>
                                                <option value="BF">Буркина-Фасо</option>
                                                <option value="BI">Бурунди</option>
                                                <option value="BT">Бутан</option>
                                                <option value="VU">Вануату</option>
                                                <option value="VA">Ватикан</option>
                                                <option value="GB">Великобритания</option>
                                                <option value="HU">Венгрия</option>
                                                <option value="VE">Венесуэла</option>
                                                <option value="VG">Виргинские о-ва (Великобритания)</option>
                                                <option value="VI">Виргинские о-ва (США)</option>
                                                <option value="UM">Внешние малые о-ва (США)</option>
                                                <option value="TL">Восточный Тимор</option>
                                                <option value="VN">Вьетнам</option>
                                                <option value="GA">Габон</option>
                                                <option value="HT">Гаити</option>
                                                <option value="GY">Гайана</option>
                                                <option value="GM">Гамбия</option>
                                                <option value="GH">Гана</option>
                                                <option value="GP">Гваделупа</option>
                                                <option value="GT">Гватемала</option>
                                                <option value="GN">Гвинея</option>
                                                <option value="GW">Гвинея-Бисау</option>
                                                <option value="DE">Германия</option>
                                                <option value="GG">Гернси</option>
                                                <option value="GI">Гибралтар</option>
                                                <option value="HN">Гондурас</option>
                                                <option value="HK">Гонконг (САР)</option>
                                                <option value="GD">Гренада</option>
                                                <option value="GL">Гренландия</option>
                                                <option value="GR">Греция</option>
                                                <option value="GE">Грузия</option>
                                                <option value="GU">Гуам</option>
                                                <option value="DK">Дания</option>
                                                <option value="JE">Джерси</option>
                                                <option value="DJ">Джибути</option>
                                                <option value="DM">Доминика</option>
                                                <option value="DO">Доминиканская Республика</option>
                                                <option value="EG">Египет</option>
                                                <option value="ZM">Замбия</option>
                                                <option value="EH">Западная Сахара</option>
                                                <option value="ZW">Зимбабве</option>
                                                <option value="IL">Израиль</option>
                                                <option value="IN">Индия</option>
                                                <option value="ID">Индонезия</option>
                                                <option value="JO">Иордания</option>
                                                <option value="IQ">Ирак</option>
                                                <option value="IR">Иран</option>
                                                <option value="IE">Ирландия</option>
                                                <option value="IS">Исландия</option>
                                                <option value="ES">Испания</option>
                                                <option value="IT">Италия</option>
                                                <option value="YE">Йемен</option>
                                                <option value="CV">Кабо-Верде</option>
                                                <option value="KZ">Казахстан</option>
                                                <option value="KH">Камбоджа</option>
                                                <option value="CM">Камерун</option>
                                                <option value="CA">Канада</option>
                                                <option value="QA">Катар</option>
                                                <option value="KE">Кения</option>
                                                <option value="CY">Кипр</option>
                                                <option value="KG">Киргизия</option>
                                                <option value="KI">Кирибати</option>
                                                <option value="CN">Китай</option>
                                                <option value="KP">КНДР</option>
                                                <option value="CC">Кокосовые о-ва</option>
                                                <option value="CO">Колумбия</option>
                                                <option value="KM">Коморы</option>
                                                <option value="CG">Конго - Браззавиль</option>
                                                <option value="CD">Конго - Киншаса</option>
                                                <option value="CR">Коста-Рика</option>
                                                <option value="CI">Кот-д&rsquo;Ивуар</option>
                                                <option value="CU">Куба</option>
                                                <option value="KW">Кувейт</option>
                                                <option value="CW">Кюрасао</option>
                                                <option value="LA">Лаос</option>
                                                <option value="LV">Латвия</option>
                                                <option value="LS">Лесото</option>
                                                <option value="LR">Либерия</option>
                                                <option value="LB">Ливан</option>
                                                <option value="LY">Ливия</option>
                                                <option value="LT">Литва</option>
                                                <option value="LI">Лихтенштейн</option>
                                                <option value="LU">Люксембург</option>
                                                <option value="MU">Маврикий</option>
                                                <option value="MR">Мавритания</option>
                                                <option value="MG">Мадагаскар</option>
                                                <option value="YT">Майотта</option>
                                                <option value="MO">Макао (САР)</option>
                                                <option value="MW">Малави</option>
                                                <option value="MY">Малайзия</option>
                                                <option value="ML">Мали</option>
                                                <option value="MV">Мальдивы</option>
                                                <option value="MT">Мальта</option>
                                                <option value="MA">Марокко</option>
                                                <option value="MQ">Мартиника</option>
                                                <option value="MH">Маршалловы Острова</option>
                                                <option value="MX">Мексика</option>
                                                <option value="MZ">Мозамбик</option>
                                                <option value="MD">Молдова</option>
                                                <option value="MC">Монако</option>
                                                <option value="MN">Монголия</option>
                                                <option value="MS">Монтсеррат</option>
                                                <option value="MM">Мьянма (Бирма)</option>
                                                <option value="NA">Намибия</option>
                                                <option value="NR">Науру</option>
                                                <option value="NP">Непал</option>
                                                <option value="NE">Нигер</option>
                                                <option value="NG">Нигерия</option>
                                                <option value="NL">Нидерланды</option>
                                                <option value="NI">Никарагуа</option>
                                                <option value="NU">Ниуэ</option>
                                                <option value="NZ">Новая Зеландия</option>
                                                <option value="NC">Новая Каледония</option>
                                                <option value="NO">Норвегия</option>
                                                <option value="BV">о-в Буве</option>
                                                <option value="IM">о-в Мэн</option>
                                                <option value="NF">о-в Норфолк</option>
                                                <option value="CX">о-в Рождества</option>
                                                <option value="SH">о-в Св. Елены</option>
                                                <option value="PN">о-ва Питкэрн</option>
                                                <option value="TC">о-ва Тёркс и Кайкос</option>
                                                <option value="HM">о-ва Херд и Макдональд</option>
                                                <option value="AE">ОАЭ</option>
                                                <option value="OM">Оман</option>
                                                <option value="KY">Острова Кайман</option>
                                                <option value="CK">Острова Кука</option>
                                                <option value="PK">Пакистан</option>
                                                <option value="PW">Палау</option>
                                                <option value="PS">Палестинские территории</option>
                                                <option value="PA">Панама</option>
                                                <option value="PG">Папуа &mdash; Новая Гвинея</option>
                                                <option value="PY">Парагвай</option>
                                                <option value="PE">Перу</option>
                                                <option value="PL">Польша</option>
                                                <option value="PT">Португалия</option>
                                                <option value="PR">Пуэрто-Рико</option>
                                                <option value="KR">Республика Корея</option>
                                                <option value="RE">Реюньон</option>
                                                <option value="RU">Россия</option>
                                                <option value="RW">Руанда</option>
                                                <option value="RO">Румыния</option>
                                                <option value="SV">Сальвадор</option>
                                                <option value="WS">Самоа</option>
                                                <option value="SM">Сан-Марино</option>
                                                <option value="ST">Сан-Томе и Принсипи</option>
                                                <option value="SA">Саудовская Аравия</option>
                                                <option value="MK">Северная Македония</option>
                                                <option value="MP">Северные Марианские о-ва</option>
                                                <option value="SC">Сейшельские Острова</option>
                                                <option value="BL">Сен-Бартелеми</option>
                                                <option value="MF">Сен-Мартен</option>
                                                <option value="PM">Сен-Пьер и Микелон</option>
                                                <option value="SN">Сенегал</option>
                                                <option value="VC">Сент-Винсент и Гренадины</option>
                                                <option value="KN">Сент-Китс и Невис</option>
                                                <option value="LC">Сент-Люсия</option>
                                                <option value="RS">Сербия</option>
                                                <option value="SG">Сингапур</option>
                                                <option value="SX">Синт-Мартен</option>
                                                <option value="SY">Сирия</option>
                                                <option value="SK">Словакия</option>
                                                <option value="SI">Словения</option>
                                                <option value="US">Соединенные Штаты</option>
                                                <option value="SB">Соломоновы Острова</option>
                                                <option value="SO">Сомали</option>
                                                <option value="SD">Судан</option>
                                                <option value="SR">Суринам</option>
                                                <option value="SL">Сьерра-Леоне</option>
                                                <option value="TJ">Таджикистан</option>
                                                <option value="TH">Таиланд</option>
                                                <option value="TW">Тайвань</option>
                                                <option value="TZ">Танзания</option>
                                                <option value="TG">Того</option>
                                                <option value="TK">Токелау</option>
                                                <option value="TO">Тонга</option>
                                                <option value="TT">Тринидад и Тобаго</option>
                                                <option value="TV">Тувалу</option>
                                                <option value="TN">Тунис</option>
                                                <option value="TM">Туркменистан</option>
                                                <option value="TR">Турция</option>
                                                <option value="UG">Уганда</option>
                                                <option value="UZ">Узбекистан</option>
                                                <option value="UA">Украина</option>
                                                <option value="WF">Уоллис и Футуна</option>
                                                <option value="UY">Уругвай</option>
                                                <option value="FO">Фарерские о-ва</option>
                                                <option value="FM">Федеративные Штаты Микронезии</option>
                                                <option value="FJ">Фиджи</option>
                                                <option value="PH">Филиппины</option>
                                                <option value="FI">Финляндия</option>
                                                <option value="FK">Фолклендские о-ва</option>
                                                <option value="FR">Франция</option>
                                                <option value="GF">Французская Гвиана</option>
                                                <option value="PF">Французская Полинезия</option>
                                                <option value="TF">Французские Южные территории</option>
                                                <option value="HR">Хорватия</option>
                                                <option value="CF">Центрально-Африканская Республика</option>
                                                <option value="TD">Чад</option>
                                                <option value="ME">Черногория</option>
                                                <option value="CZ">Чехия</option>
                                                <option value="CL">Чили</option>
                                                <option value="CH">Швейцария</option>
                                                <option value="SE">Швеция</option>
                                                <option value="SJ">Шпицберген и Ян-Майен</option>
                                                <option value="LK">Шри-Ланка</option>
                                                <option value="EC">Эквадор</option>
                                                <option value="GQ">Экваториальная Гвинея</option>
                                                <option value="ER">Эритрея</option>
                                                <option value="SZ">Эсватини</option>
                                                <option value="EE">Эстония</option>
                                                <option value="ET">Эфиопия</option>
                                                <option value="GS">Южная Георгия и Южные Сандвичевы о-ва</option>
                                                <option value="ZA">Южно-Африканская Республика</option>
                                                <option value="SS">Южный Судан</option>
                                                <option value="JM">Ямайка</option>
                                                <option value="JP">Япония</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <label>Возраст</label>
                                        <input id="range_1" type="text" name="age" value="">
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-sm">
                                        <label>Пол</label>
                                        <br>

                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-primary active">
                                                <input type="radio" name="gender" id="option1"  checked value="0"> Все
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="gender" id="option2" value="1" > Мужской
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="gender" id="option3" value="2"> Женский
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>

<!--                    <div class="row">-->
<!--                        <div class="col-sm">-->
<!--                            <label>Устройства</label>-->
<!--                            <br>-->
<!---->
<!--                            <div class="btn-group btn-group-toggle" data-toggle="buttons">-->
<!--                                <label class="btn btn-primary active">-->
<!--                                    <input type="radio" name="device_platforms" id="all_device"  checked value="0"> Все-->
<!--                                </label>-->
<!--                                <label class="btn btn-primary">-->
<!--                                    <input type="radio" name="device_platforms" id="mobile" value="1" > Мобильные-->
<!--                                </label>-->
<!--                                <label class="btn btn-primary">-->
<!--                                    <input type="radio" name="device_platforms" id="desctop" value="2"> Десктоп-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <br>-->

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control select2bs4" name="status_adset" style="width: 100%;">
                                                    <option value="0">PAUSED</option>
                                                    <option value="1">ACTIVE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                    <blockquote>Объявление</blockquote>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Название объявления</label>
                                <input class="form-control" type="text" name="name_ad" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div    class="form-group">
                                <label>Текст объявления</label>
                            <textarea class="form-control" type="text" name="body_ad" value="" ></textarea>
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
</div>
					<?php include "includes/footer.php";?>
				