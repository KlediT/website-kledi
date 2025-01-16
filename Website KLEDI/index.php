<?php 

	require "functions.php";

	check_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>my website</title>
</head>
<body>

	<?php require_once "header.php";?>

				<div style="max-width: 600px;margin: auto;">

					<h3 style="text-align: center;">Timeline</h3>
					<?php 
						
						$query = "select * from posts order by id desc limit 10";

						$result = mysqli_query($con,$query);
					?>

					<?php if(mysqli_num_rows($result) > 0):?>

						<?php while ($row = mysqli_fetch_assoc($result)):?>

							<?php 
								$user_id = $row['user_id'];
								$query = "select username,image from users where id = '$user_id' limit 1";
								$result2 = mysqli_query($con,$query);

								$user_row = mysqli_fetch_assoc($result2);
							?>
							<div style="background-color:white;display: flex;border:solid thin #aaa;border-radius: 10px;margin-bottom: 10px;margin-top: 10px;">
								<div style="flex:1;text-align: center;">
									<img src="<?=$user_row['image']?>" style="border-radius:50%;margin:10px;width:100px;height:100px;object-fit: cover;">
									<br>
									<?=$user_row['username']?>
								</div>
								<div style="flex:8">
									<?php if(file_exists($row['image'])):?>
										<div>
											<img src="<?=$row['image']?>" style="width:100%;height:200px;object-fit: cover;">
										</div>
									<?php endif;?>
									<div>
										<div style="color:#888"><?=date("jS M, Y",strtotime($row['date']))?></div>
										<?php echo nl2br(htmlspecialchars($row['post']))?>
									</div>
								</div>
								
							</div>
						<?php endwhile;?>
					<?php endif;?>
				</div>

	<?php require "footer.php";?>

</body>
</html>