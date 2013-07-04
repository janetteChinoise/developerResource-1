<?php
  /**
   * 字符串截取，支持中文和其他编码
   * @static
   * @access public
   * @param string $str 需要转换的字符串
   * @param string $start 开始位置
   * @param string $length 截取长度
   * @param string $charset 编码格式
   * @param string $suffix 截断显示字符
   * @return string
   */
  function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
  {
      if(strlen($str) < $start+1)
      {
          return '';
      }

      if(strlen($str) <= $length)
      {
          return $str;
      }

      preg_match_all("/./su", $str, $ar);
      $str = '';
      $tstr = '';

      for($i=0; isset($ar[0][$i]); $i++)
      {
          if(strlen($tstr) < $start)
          {
              $tstr .= $ar[0][$i];
          }
          else
          {
              if(strlen($str) < $length + strlen($ar[0][$i]) )
              {
                  $str .= $ar[0][$i];
              }
              else
              {
                  break;
              }
          }
      }
      return $suffix==true ? $str.'...' : $str;
  }

  /**
   * 过滤文字后截取字符串
   *
   * @return string
   **/
  function clean_msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
  {
    return msubstr(strip_tags(str_replace('　','',trim($str))),$start,$length,$charset,$suffix);
  }
?>