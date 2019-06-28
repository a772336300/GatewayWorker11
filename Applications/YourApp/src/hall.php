<?php
function hall_message_switch($mid,$data){
    $uid=$_SESSION['uid'];
    switch ($mid){
        case 20001://修改头像信息
            $user_touxiang = new \Proto\CS_User_TouXiang_Update();
            $user_touxiang->parseFromString($data);
            $touxiang=$user_touxiang->getTouxiang();
            $sql="update user set touxiang='$touxiang' where uid=$uid";
            $is_success = true;
            if(db_query($sql)==null){
                $is_success = false;
            }
            send_pack_user_touxiang_update($uid,$is_success);
            break;
        case 20003:

            break;
    }
}