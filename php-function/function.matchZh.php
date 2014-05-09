<?php
	/*
	1. GBK (GB2312/GB18030)
	/x00-/xff  GBK双字节编码范围
	/x20-/x7f  ASCII
	/xa1-/xff  中文
	/x80-/xff  中文
	2. UTF-8 (Unicode)
	/u4e00-/u9fa5 (中文)
	/x3130-/x318F (韩文
	/xAC00-/xD7A3 (韩文)
	/u0800-/u4e00 (日文)
	ps: 韩文是大于[/u9fa5]的字符
	*/

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