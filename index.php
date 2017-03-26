<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>纳米材料与器件辐照效应</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 0px;
        padding-bottom: 0px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
  </head>

  <script src="js/jquery-3.2.0.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <body>

    <div class="container-fluid" style="background-color:#8f000b">
        <img src="img/logo.png"></img>
    </div>

    <div class="navbar navbar-inverse navbar-static-top">
      <div class="navbar-inner">
          <div class="nav-collapse collapse">
            <ul class="nav pagenav">
              <li id="HOME"> <a href="index.php?pageName=HOME">首页</a> </li>
              <li id="TUTOR"> <a href="index.php?pageName=TUTOR">导师介绍</a> </li>
              <li id="RESEARCH"> <a href="index.php?pageName=RESEARCH">科研领域</a> </li>
              <li id="MEMBER"> <a href="index.php?pageName=MEMBER">人员构成</a> </li>
              <li id="NEWS"> <a href="index.php?pageName=NEWS">组内动态</a> </li>
              <li id="CONTACT"> <a href="index.php?pageName=CONTACT">联系我们</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div class="container-fluid" style="padding:0px">
      <?php
		$pageName="HOME";
		$partName="";
		if(strlen($_GET['partName'])>0){
			$partName=$_GET['partName'];
		}
		if($_GET["pageName"]!=""){
			$pageName=$_GET["pageName"];
		}

		if($pageName=="SINGLE"){
			require($partName);
		}
		
		else{
			$conFile=file($pageName . "/content.txt");
			$conList=array();
			foreach ($conFile as $line){
				list($title,$file)=explode("|",$line);
				$file=trim($file);
				$conList[$title]=$file;
			}
			reset($conList);
			$partName=current($conList);
			if(strlen($_GET['partName'])>0){
				$partName=$_GET['partName'];
			}

			if (count($conList)>1){
				printf('<div class="row-fluid">');
				printf('<div class="span3" style="padding:20px"> <div class="well sidebar-nav"> <ul class="nav nav-list">');
				while($key=key($conList)){
					if($partName==$conList[$key]){
						printf('<li class="active"><a href="%s">%s</a></li>', "index.php?pageName=" . $pageName . "&partName=" . $conList[$key], $key);
					}else{
						printf('<li><a href="%s">%s</a></li>', "index.php?pageName=" . $pageName . "&partName=" . $conList[$key], $key);
					}
					next($conList);
				}
				printf('</ul> </div> </div>');

				printf('<div class="span9" style="padding:20px;">');
				require($pageName . "/" . $partName);
				printf('</div>');

				printf('</div>');
			}else{
				require($pageName . "/" . $partName);
			}

			printf('<script type="text/javascript"> $(".pagenav>li").removeClass("active"); $("#%s").addClass("active"); </script>', $pageName);
		}
	?>
    </div>
 
    <div class="container-fluid text-center" style="padding:0px;color:#fff;background-color:#000000; position:static; bottom:0px;">
		地址：北京市成府路201号 | 邮编：100871 | 邮箱：jmxue@pku.edu.cn | 电话：010-62758494
    </div>
 </body>
</html>

