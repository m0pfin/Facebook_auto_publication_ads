<?php
		include("includes/connect.php");
        include("includes/db.php");
        include("func/getInfo.php");
        include("func/getStatusToken.php");

		$cat = $_POST['cat'];
		$cat_get = $_GET['cat'];
		$act = $_POST['act'];
		$act_get = $_GET['act'];
		$id = $_POST['id'];
		$id_get = $_GET['id'];

		
				if($cat == "accounts" || $cat_get == "accounts"){
		$name = mysqli_real_escape_string($link,$_POST["name"]);
        $token = mysqli_real_escape_string($link,$_POST["token"]);
        $adtrust_dsl = mysqli_real_escape_string($link,$_POST["adtrust_dsl"]);
        $user_id = '0';
        $user_name = '0';
        $status = '0';
        $getProxy = mysqli_real_escape_string($link,$_POST["proxy"]);

        /**
         * Получаем инфу об аккаунте
        */
            $getProxy = $db->fetch("SELECT * FROM proxy WHERE id='".$getProxy."'");
            $proxy = $getProxy['ip'].':'.$getProxy['port'].':'.$getProxy['login'].':'.$getProxy['pass'];

                $getUserInfo = getUserInfo($curl, $proxy, $token);

                    if (isset($getUserInfo['id'])){
                        $user_id = $getUserInfo['id'];
                        $user_name = $getUserInfo['name'];
                    }else{
                        $status = '1';
                    }


                    /**
                     * В header добавляем $_GET параметр для Toastr уведомлений
                     */
				if($act == "add"){
					mysqli_query($link, "INSERT INTO `accounts` ( `name` , `token` , `adtrust_dsl`, `user_id`, `user_name`, `proxy_id`, `status`) VALUES ( '".$name."' , '".$token."' , '".$adtrust_dsl."', '".$user_id."', '".$user_name."', '".$getProxy['id']."', '".$status."') ");
                    header("location:"."accounts.php?status=success&name=".$name."");
				}elseif ($act == "edit"){
                        mysqli_query($link, "UPDATE `accounts` SET  `name` =  '".$name."' , `token` =  '".$token."' ,  `adtrust_dsl` =  '".$adtrust_dsl."'  WHERE `id` = '".$id."' ");
                    header("location:"."accounts.php?status=update&name=".$name."");
					}elseif ($act_get == "delete"){
						mysqli_query($link, "DELETE FROM `accounts` WHERE id = '".$id_get."' ");
                    header("location:"."accounts.php?status=delete&name=".$id_get."");
					}
					//header("location:"."accounts.php");
				}
				
				if($cat == "ad_account" || $cat_get == "ad_account"){
					$accounts_id = mysqli_real_escape_string($link,$_POST["accounts_id"]);
$name = mysqli_real_escape_string($link,$_POST["name"]);
$pixel_id = mysqli_real_escape_string($link,$_POST["pixel_id"]);
$adtrust_dsl = mysqli_real_escape_string($link,$_POST["adtrust_dsl"]);
$billing = mysqli_real_escape_string($link,$_POST["billing"]);
$amount = mysqli_real_escape_string($link,$_POST["amount"]);
$adaccount_id = mysqli_real_escape_string($link,$_POST["adaccount_id"]);


				if($act == "add"){
					mysqli_query($link, "INSERT INTO `ad_account` (  `accounts_id` , `name` , `pixel_id` , `adtrust_dsl` , `billing` , `amount` , `adaccount_id` ) VALUES ( '".$accounts_id."' , '".$name."' , '".$pixel_id."' , '".$adtrust_dsl."' , '".$billing."' , '".$amount."' , '".$adaccount_id."' ) ");
				}elseif ($act == "edit"){
					mysqli_query($link, "UPDATE `ad_account` SET  `accounts_id` =  '".$accounts_id."' , `name` =  '".$name."' , `pixel_id` =  '".$pixel_id."' , `adtrust_dsl` =  '".$adtrust_dsl."' , `billing` =  '".$billing."' , `amount` =  '".$amount."' , `adaccount_id` =  '".$adaccount_id."'  WHERE `id` = '".$id."' "); 	
					}elseif ($act_get == "delete"){
						mysqli_query($link, "DELETE FROM `ad_account` WHERE id = '".$id_get."' ");
					}
					header("location:"."ad_account.php");
				}
				
				if($cat == "cards" || $cat_get == "cards"){
					$cardNumber = mysqli_real_escape_string($link,$_POST["cardNumber"]);
$moth = mysqli_real_escape_string($link,$_POST["moth"]);
$year = mysqli_real_escape_string($link,$_POST["year"]);
$cvv = mysqli_real_escape_string($link,$_POST["cvv"]);


				if($act == "add"){
					mysqli_query($link, "INSERT INTO `cards` (  `cardNumber` , `moth` , `year` , `cvv` ) VALUES ( '".$cardNumber."' , '".$moth."' , '".$year."' , '".$cvv."' ) ");
                    header("location:"."cards.php?status=success&name=".$cardNumber."");
				}elseif ($act == "edit"){
					mysqli_query($link, "UPDATE `cards` SET  `cardNumber` =  '".$cardNumber."' , `moth` =  '".$moth."' , `year` =  '".$year."' , `cvv` =  '".$cvv."'  WHERE `id` = '".$id."' ");
                    header("location:"."cards.php?status=update&name=".$cardNumber."");
				}elseif ($act_get == "delete"){
						mysqli_query($link, "DELETE FROM `cards` WHERE id = '".$id_get."' ");
                    header("location:"."cards.php?status=delete&name=".$id_get."");
					}
					//header("location:"."cards.php?status=success&name=".$cardNumber."");
				}
				

				if($cat == "preset" || $cat_get == "preset"){

//$name = mysqli_real_escape_string($link,$_POST["name"]);
//$objective = mysqli_real_escape_string($link,$_POST["objective"]);
//$status = mysqli_real_escape_string($link,$_POST["status"]);
//$special_ad_categories = mysqli_real_escape_string($link,$_POST["special_ad_categories"]);
//$campaign_id = mysqli_real_escape_string($link,$_POST["campaign_id"]);

                    $age = $_POST['age'];
                    $age = explode(';', $age);

$name_campaign = mysqli_real_escape_string($link, $_POST['name_campaign']);
$status_campaign = mysqli_real_escape_string($link, $_POST['status_campaign']);
$objective = mysqli_real_escape_string($link, $_POST['objective']);
$name_adset = mysqli_real_escape_string($link, $_POST['name_adset']);
$daily_budget_adset = mysqli_real_escape_string($link, $_POST['daily_budget_adset']);
$start_time = mysqli_real_escape_string($link, $_POST['start_time']);
$end_time = mysqli_real_escape_string($link, $_POST['end_time']);
$bid_strategy = mysqli_real_escape_string($link, $_POST['bid_strategy']);
$billing_event = mysqli_real_escape_string($link, $_POST['billing_event']);
$optimization_goal = mysqli_real_escape_string($link, $_POST['optimization_goal']);
$custom_event_type = mysqli_real_escape_string($link, $_POST['custom_event_type']);
$targeting_geo_countries = mysqli_real_escape_string($link, $_POST['targeting_geo_countries']);
$publisher_platforms = '0'; // mysqli_real_escape_string($link, $_POST['publisher_platforms']);
$device_platforms = '0'; // mysqli_real_escape_string($link, $_POST['device_platforms']);
$age_min = mysqli_real_escape_string($link, $age[0]);
$age_max = mysqli_real_escape_string($link, $age[1]);
$gender = mysqli_real_escape_string($link, $_POST['gender']);
$status_adset = mysqli_real_escape_string($link, $_POST['status_adset']);
$name_ad = mysqli_real_escape_string($link, $_POST['name_ad']);
$body_ad = mysqli_real_escape_string($link, $_POST['body_ad']);


				if($act == "add"){
					mysqli_query($link, "INSERT INTO `preset`(`name_campaign`, `status_campaign`, `objective`, `name_adset`, `daily_budget_adset`, `start_time`, `end_time`, `bid_strategy`, `billing_event`, `optimization_goal`, `custom_event_type`, `targeting_geo_countries`, `publisher_platforms`, `device_platforms`, `age_min`, `age_max`, `gender`, `status_adset`, `name_ad`, `body_ad`) VALUES ('".$name_campaign."' , '".$status_campaign."' , '".$objective."' , '".$name_adset."' , '".$daily_budget_adset."' , '".$start_time."'  , '".$end_time."'  , '".$bid_strategy."'  , '".$billing_event."'  , '".$optimization_goal."'  , '".$custom_event_type."'  , '".$targeting_geo_countries."' , '".$publisher_platforms."' , '".$device_platforms."' , '".$age_min."' , '".$age_max."' , '".$gender."'    , '".$status_adset."'  , '".$name_ad."'  , '".$body_ad."' ) ");

				}elseif ($act == "edit"){
					mysqli_query($link, "UPDATE `preset`  SET `name_campaign`='". $name_campaign ."',`status_campaign`='". $status_campaign ."',`objective`='". $objective ."',`name_adset`='". $name_adset ."',`daily_budget_adset`='". $daily_budget_adset ."',`start_time`='". $start_time ."',`end_time`='". $end_time ."',`bid_strategy`='". $bid_strategy ."',`billing_event`='". $billing_event ."',`optimization_goal`='". $optimization_goal ."',`custom_event_type`='". $custom_event_type ."',`targeting_geo_countries`='". $targeting_geo_countries ."',`publisher_platforms`='". $publisher_platforms ."',`device_platforms`='". $device_platforms ."',`age_min`='". $age_min ."',`age_max`='". $age_max ."',`gender`='". $gender ."',`status_adset`='". $status_adset ."',`name_ad`='". $name_ad ."',`body_ad`='". $body_ad ."'  WHERE `id` = '".$id."' ");
					}elseif ($act_get == "delete"){
						mysqli_query($link, "DELETE FROM `preset` WHERE id = '".$id_get."'");
					}

                    $error = mysqli_error($link);

                    if (empty($error)) {
                        header("location:"."preset.php");
                    } else {
                        echo 'Ошибка добавления в БД: ' . $error;
                    }

				}
				
				if($cat == "proxy" || $cat_get == "proxy"){
					$ip = mysqli_real_escape_string($link,$_POST["ip"]);
$port = mysqli_real_escape_string($link,$_POST["port"]);
$login = mysqli_real_escape_string($link,$_POST["login"]);
$pass = mysqli_real_escape_string($link,$_POST["pass"]);


				if($act == "add"){
					mysqli_query($link, "INSERT INTO `proxy` (  `ip` , `port` , `login` , `pass` ) VALUES ( '".$ip."' , '".$port."' , '".$login."' , '".$pass."' ) ");
                    header("location:"."proxy.php?status=success&name=".$ip."");
				}elseif ($act == "edit"){
					mysqli_query($link, "UPDATE `proxy` SET  `ip` =  '".$ip."' , `port` =  '".$port."' , `login` =  '".$login."' , `pass` =  '".$pass."'  WHERE `id` = '".$id."' ");
                    header("location:"."proxy.php?status=update&name=".$ip."");
				}elseif ($act_get == "delete"){
						mysqli_query($link, "DELETE FROM `proxy` WHERE id = '".$id_get."' ");
                    header("location:"."proxy.php?status=delete&name=".$id_get."");
					}
					//header("location:"."proxy.php");
				}
				
				if($cat == "users" || $cat_get == "users"){
					$name = mysqli_real_escape_string($link,$_POST["name"]);
$email = mysqli_real_escape_string($link,$_POST["email"]);
$password = mysqli_real_escape_string($link,$_POST["password"]);
$role = mysqli_real_escape_string($link,$_POST["role"]);


				if($act == "add"){
					mysqli_query($link, "INSERT INTO `users` (  `name` , `email` , `password` , `role` ) VALUES ( '".$name."' , '".$email."' , '".md5($password)."', '".$role."' ) ");
				}elseif ($act == "edit"){
					mysqli_query($link, "UPDATE `users` SET  `name` =  '".$name."' , `email` =  '".$email."' , `role` =  '".$role."'  WHERE `id` = '".$id."' "); 	
					}elseif ($act_get == "delete"){
						mysqli_query($link, "DELETE FROM `users` WHERE id = '".$id_get."' ");
					}
					header("location:"."users.php");
				}
				?>