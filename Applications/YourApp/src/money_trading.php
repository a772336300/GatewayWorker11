<?php
use Workerman\Connection\AsyncTcpConnection;

function user_recharge($userid,$variable,$code)
{
    db_user_recharge_query($userid,$variable,$code);
}

function user_tixian($userid,$variable)
{
    db_user_tixian_query($userid,$variable);
}
