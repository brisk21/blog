<?php

class page{
	public $maxPage;
	
	function __construct($dataTotal,$pageTotal,$p,$file){
		$this->maxPage = ceil($dataTotal / $pageTotal);
		$this->p = $p;
		$this->file =$file;
	}
	function showPage(){	
		$html ="";//用于保存生成的HTML分页
		for($i=1; $i <= $this->maxPage; $i++){
			if($this ->p == $i){
				$html.="<li><a style='color:red;' href='{$this->file}?p=$i'>[$i]</a></li>";//当前页
			}else{			
				$html.="<li><a href='{$this->file}?p=$i'>[$i]</a></li>";
			}			
		}
		return $html;
	}
}