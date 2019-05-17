<?php
function Byte2Int($value)
 {
 	return unpack("I",$value);
 }
function my_pack_with_len($len,$mid,$body)
{
    //4 + 4 +proto
    //return Int2Byte($len).Int2Byte($mid).Int2Byte($id).$body;
    return pack("I*",$len).pack("I*",$mid).$body;
}
function my_pack($mid,$body)
 {
     //4 + 4 +proto
 	//return Int2Byte($len).Int2Byte($mid).Int2Byte($id).$body;
 	return pack("I*",8+strlen($body)).pack("I*",$mid).$body;
 }
function my_pack_with_uid($mid,$phone,$body)
{
    //return Int2Byte($len).Int2Byte($mid).Int2Byte($id).$body;
    return pack("I*",20+strlen($body)).pack("I*",$mid).pack("I*",1).pack("P*",$phone).$body;
}
function my_unpack($value)
 {
 	return array(substr($value,12),substr($value,12));
 }
 function my_unpack_uid($value)
 {
     return unpack("I*",substr($value,0,4));
 }