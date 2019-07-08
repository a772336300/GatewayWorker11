<?php

class mj_base{
    private $Card_All;
    private $Play_Count;

    /**
     * @return 随机点
     */
    public function Rand_Point(){
        return time() % $this->Play_Count;
    }

    /**
     * @param $_multi 输入的多维数组容器
     * @return 转换后的一维数组
     */
    public  function Multi_To_One_Array($_multi){
        $_one = [];
        array_walk_recursive($_multi,function ($vale) use (&$_one){
            array_push($_one,$vale);
        });
        return $_one;
    }

    /**
     * mj_base constructor.
     * @param $value
     *        1 =》 条 筒 万
     *        2 =》 条 筒
     *        3 =》 条 筒 万 东、南、西、北、中、发财、白板
     *        $count 人数
     */
    public function __construct($value,$count){
        $tmpdata = [
                1 => [11,11,11,11,12,12,12,12,13,13,13,13,14,14,14,14,15,15,15,15,16,16,16,16,17,17,17,17,18,18,18,18,19,19,19,19],//条 36
                2 => [21,21,21,21,22,22,22,22,23,23,23,23,24,24,24,24,25,25,25,25,26,26,26,26,27,27,27,27,28,28,28,28,29,29,29,29],//筒 36
                3 => [31,31,31,31,32,32,32,32,33,33,33,33,34,34,34,34,35,35,35,35,36,36,36,36,37,37,37,37,38,38,38,38,39,39,39,39],//万 36
                4 => [41,41,41,41,42,42,42,42,43,43,43,43,44,44,44,44,45,45,45,45,46,46,46,46,47,47,47,47] //东、南、西、北、中、发财、白板 28
        ];
        $tmp_array = [];
        switch ($value){
            case 1:
                array_push($tmp_array,$tmpdata[1],$tmpdata[2],$tmpdata[3]);
                break;
            case 2:
                array_push($tmp_array,$tmpdata[1],$tmpdata[2]);
                break;
            case 3:
                array_push($tmp_array,$tmpdata[1],$tmpdata[2],$tmpdata[3],$tmpdata[4]);
                break;
        }
        self::$Card_All = $this->Multi_To_One_Array($tmp_array);
        self::$Play_Count = $count;
    }

    /**
     * @return 所有的未摸的牌或剩余的牌
     */
    public function Get_All_Card(){
        return self::$Card_All;
    }

    /**
     * @return 洗牌
     */
    private function Rand_Card(){
        return shuffle(self::$Card_All);
    }

    /**
     * @return 摸牌
     */
    private function Get_Card(){
        return array_shift(self::$Card_All);
    }

    /**
     * @param $count 首次摸牌张数
     * @return 首次摸牌ALL
     */
    private function Get_First_Card_All($count){
        $play_card = null;
        for ($i=0;$i<$count;$i++){
            for ($j=0;$j<self::$Play_Count;$j++){
                array_push($play_card[$j],$this->Get_Card());
            }
        }
        return $play_card;
    }
}
