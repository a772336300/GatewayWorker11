<?php
function encode_to_play_data($string_data)
{
    $data = json_decode($string_data,true);
    $play_data = new \Proto\Play_Data();
    $play_data->setType($data['type']);
    $play_data->setData($data['data']);
    return $play_data;
}
