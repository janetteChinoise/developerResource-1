<?php
	function matchZh($string, $encoding = 'utf-8')
	{
	    if (strtolower($encoding) == 'utf-8') {
	        $pattern = "/[\x{4e00}-\x{9fa5}]/u"; //是否包含汉字
	        //$pattern = "/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u"; //汉字字母数字下划线正则表达式
	    } else {
	        $pattern = "/[".chr(0xa1)."-".chr(0xff)."]/"; //是否包含汉字
	        //$pattern = "/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]+$/"; //汉字字母数字下划线正则表达式
	    }

	    return preg_match($pattern,$string);
	}
?>