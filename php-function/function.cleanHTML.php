<?php
/**
 * 去除复制的word文档多余的标签
 *
 **/
function cleanHTML($html) {
	$html = ereg_replace("<(/)?(font|span|del|ins)[^>]*>","",$html);
	// then run another pass over the html (twice), removing unwanted attributes
	$html = ereg_replace("<([^>]*)(class|lang|style|size|face)=(\"[^"]*\"|'[^']*'|[^>]+)([^>]*)>","<\1>",$html);
	return $html;
}
?>