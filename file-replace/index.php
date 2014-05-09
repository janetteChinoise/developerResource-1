<?php
  function scan_dir($dirname){
		if (is_dir($dirname)) {
			$str = '';
			$arr = glob($dirname.'/*');
			foreach ($arr as $value) {
				$str .= '<li><input type="checkbox" name="file[]" id="'.$value.'" value="'.$value.'"><label for="'.$value.'">'.$value.'</label>';
				if (is_dir($value)) { $str .= '<ul>'.scan_dir($value).'</ul>'; }
				$str .= '</li>';
			}
		}
		return $str;
	}
?>
<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>文件替换</title>
	<link rel="stylesheet" href="static/jquery.treeview.css">
	<style>
		*{margin: 0;padding: 0;}
		#wraper{width: 920px;margin: 0px auto; padding: 20px; border:1px solid #999;}
		h1{line-height: 33px;font-size: 16px;}
		li{list-style: none;}
		input[type='checkbox']{margin-right: 5px;}
		#sites{zoom:1}
		#sites:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0}
		#sites li{float: left; margin-right: 12px;width: 25%;text-align: center;}
	</style>

</head>
<body>
	<?php
		if($_POST) {
			foreach ($_POST['site'] as $site) {
				foreach ($_POST['file'] as $file) {
					$sitefile = $site.substr($file, strpos($file, '/'));
					if (is_dir($file) && !is_dir($sitefile)) {
						mkdir($sitefile);
					} else {
						if (file_exists($sitefile)) {
							@unlink($sitefile);
							copy($file, $sitefile);
						} else {
							fopen($sitefile, 'w');
							copy($file, $sitefile);
						}
					}
				}
			}
			header("location:replace.php");
		}
	?>
	<div id="wraper">
		<form action="" method="post">
			<h1>需要替换的文件</h1>
			<ul id="navigation">
				<?php echo scan_dir('original'); ?>
			</ul>

			<h1>分支列表</h1>
			<ul id="sites">
			<?php foreach (glob('branch/*') as $dir): ?>
			<?php if ($dir != 'original'): ?>
				<li><input type="checkbox" name="site[]" value="<?php echo $dir;?>" id="<?php echo $dir;?>"><label for="<?php echo $dir;?>"><?php echo $dir;?></label></li>
			<?php endif ?>
			
			<?php endforeach ?>
			</ul>
			<p><input type="submit" value="提交"></p>
		</form>
	</div>

	<script src="static/jquery.js" type="text/javascript"></script>
	<script src="static/jquery.treeview.js" type="text/javascript"></script>
	<script>
	$(function(){
		$('li label').click(function(){
			var status = $(this).prev().attr('checked');
			$(this).next('ul').find('input[type="checkbox"]').attr('checked', status==false);
		});

		$("#navigation").treeview({
			persist: "location",
			collapsed: true,
			unique: true
		});

		$('form').submit(function(){
			if($('input[name="file[]"]:checked').size() == 0 || $('input[name="site[]"]:checked').size() == 0) {
				return false;
			}
		});
	});
	</script>
</body>
</html>