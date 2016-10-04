<?php

class page{
	public $maxPage;
	
	function __construct($dataTotal,$pageTotal,$p,$file){
		$this->maxPage = ceil($dataTotal / $pageTotal);
		$this->p = $p;
		$this->file =$file;
	}
	function showPage(){	
		$html ="";//���ڱ������ɵ�HTML��ҳ
		for($i=1; $i <= $this->maxPage; $i++){
			if($this ->p == $i){
				$html.="<li><a style='color:red;' href='{$this->file}?p=$i'>[$i]</a></li>";//��ǰҳ
			}else{			
				$html.="<li><a href='{$this->file}?p=$i'>[$i]</a></li>";
			}			
		}
		return $html;
	}
}