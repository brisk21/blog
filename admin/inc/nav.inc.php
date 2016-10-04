﻿<nav class="navbar navbar-default navbar-inverse">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo ADM_URL_PATH;?>/admin">AdminPanel</a>
					</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li ><a href="<?php echo ADM_URL_PATH;?>/admin/blog.php">日志管理</a></li>
							<li><a href="<?php echo ADM_URL_PATH;?>/admin/admin.php">管理员管理</a></li>
							<li><a href="<?php echo ADM_URL_PATH;?>/admin/settings.php">基本设置</a></li>						
						</ul>
						
						<ul class="nav navbar-nav navbar-right">							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user['auname'];?>  <span class="caret"></span></a>
								<ul class="dropdown-menu">									
									<li><a href="#">待扩展功能</a></li>
									<li><a href=".././index.php">返回首页</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="<?php echo ADM_URL_PATH;?>/admin/login.php?do=out">退出登录</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>