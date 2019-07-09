<?php

use Workerman\Lib\Timer;
use GatewayWorker\Lib\Gateway;
use Events;
use mj_base;

class game_xzdd extends mj_base {
    private static $_handCards;     //玩家手牌
    private static $_barCards;      //玩家杠牌
    private static $_knownCards;    //所有打出的牌
    private static $_handCardsCountMap;
    private static $_splitArr;
    /**
     * 和牌所用到的参数.
     * @var $params = [
     *           'is_last_card' => 1,
     *           'is_zi_mo' => 1,
     *           'is_gang_mo_pai' => 0,
     *           'is_qiang_gang_hu' => 0,
     *           'ming_gang_count' => 0,
     *           'an_gang_count' => 0,
     *           'is_hu_jue_zhang' => 0,
     *           'men_fen' => 2,
     *           'quan_fen' => 1,
     *           'hu_card' => 11,
     *           'is_ting' => 0,
     *           'flower_count' => 1,
     *           'mj_type' => 1,
     *           'play_count =>4
     *      ]
     */
    private static $_params;

    /**
     * 构造方法.
     *
     * @param $handCards
     * @param $knownCards
     */
    public function __construct($handCards, $knownCards = [], $params = [], $isSplitCard = true)
    {
        sort($handCards);
        self::$_handCards = $handCards;
        self::$_knownCards = $knownCards;

        parent::__construct($params['mj_type'],$params['play_count']);
/*
        if (!empty($knownCards)) {
            array_walk_recursive($knownCards, function ($value) use (&$handCards) {
                array_push($handCards, $value);
            });
        }
        self::$_handCardsCountMap = array_count_values($handCards);

        if ($isSplitCard) {
            self::$_splitArr = $this->_splitCard();
            echo "===========拆牌结果==================\n";
            print_r(self::$_splitArr);
            echo "=============================\n";
        }
*/
        self::$_params = $params;
    }

    private function Start_Game(){

    }

    private function Loop_Game(){

    }

    /**
     * 算番.
     */
    public function calHandCardsPoints()
    {

        $fanCateList = [];
        if ($this->_isDaSiXi()) {
            $fanCateList[] = self::F_DaSiXi;
        } elseif ($this->_isDaSanYuan()) {
            $fanCateList[] = self::F_DaSanYuan;
        } elseif ($this->_isShiSanYao()) {
            $fanCateList[] = self::F_ShiSanYao;
        } elseif ($this->_isJiuLianBaoDeng()) {
            $fanCateList[] = self::F_JiuLianBaoDeng;
        } elseif ($this->_isLianQiDui()) {
            $fanCateList[] = self::F_LianQiDui;
        } elseif ($this->_isLvYiSe()) {
            $fanCateList[] = self::F_LvYiSe;
        } elseif ($this->_isSiGang()) {
            $fanCateList[] = self::F_SiGang;
        } elseif ($this->_isXiaoSanYuan()) {
            $fanCateList[] = self::F_XiaoSanYuan;
        } elseif ($this->_isXiaoSiXi()) {
            $fanCateList[] = self::F_XiaoSiXi;
        } elseif ($this->_isQingYaoJiu()) {
            $fanCateList[] = self::F_QingYaoJiu;
        } elseif ($this->_isYiSeShuangLongHui()) {
            $fanCateList[] = self::F_YiSeShuangLongHui;
        } elseif ($this->_isZiYiSe()) {
            $fanCateList[] = self::F_ZiYiSe;
        } elseif ($this->_isSiAnKe()) {
            $fanCateList[] = self::F_SiAnKe;
        } elseif ($this->_isYiSeSiJieGao()) {
            $fanCateList[] = self::F_YiSeSiJieGao;
        } elseif ($this->_isYiSeSiTongShun()) {
            $fanCateList[] = self::F_YiSeSiTongShun;
        } elseif ($this->_isYiSeSiBuGao()) {
            $fanCateList[] = self::F_YiSeSiBuGao;
        } elseif (!in_array(self::F_ShiSanYao, $fanCateList) && $this->_isHunYaoJiu()) {
            $fanCateList[] = self::F_HunYaoJiu;
        } elseif (empty(array_intersect([self::F_SiGang], $fanCateList)) && $this->_isSanGang()) {
            $fanCateList[] = self::F_SanGang;
        } elseif (empty(array_intersect([self::F_SiGang, self::F_YiSeShuangLongHui], $fanCateList)) && $this->_isQiDui()) {
            $fanCateList[] = self::F_QiDui;
        } elseif ($this->_isQiXingBuKao()) {
            $fanCateList[] = self::F_QiXingBuKao;
        } elseif ($this->_isQuanShuangKe()) {
            $fanCateList[] = self::F_QuanShuangKe;
        } elseif ($this->_isQuanDa()) {
            $fanCateList[] = self::F_QuanDa;
        } elseif ($this->_isQuanZhong()) {
            $fanCateList[] = self::F_QuanZhong;
        } elseif (empty(array_intersect([self::F_YiSeSiTongShun, self::F_YiSeSanTongShun], $fanCateList)) && $this->_isYiSeSanJieGao()) {
            $fanCateList[] = self::F_YiSeSanJieGao;
        } elseif (empty(array_intersect([self::F_YiSeSiJieGao, self::F_YiSeSanJieGao], $fanCateList)) && $this->_isYiSeSanTongShun()) {
            $fanCateList[] = self::F_YiSeSanTongShun;
        } elseif ($this->_isQingLong()) {
            $fanCateList[] = self::F_QingLong;
        } elseif ($this->_isYiSeSanBuGao()) {
            $fanCateList[] = self::F_YiSeSanBuGao;
        } elseif ($this->_isSanSeShuangLongHui()) {
            $fanCateList[] = self::F_SanSeShuangLongHui;
        } elseif ($this->_isShiSanBuKao()) {
            $fanCateList[] = self::F_ShiSanBuKao;
        } elseif ($this->_isZhuHeLong()) {
            $fanCateList[] = self::F_ZhuHeLong;
        } elseif (empty(array_intersect([self::F_DaSiXi, self::F_XiaoSiXi], $fanCateList)) && $this->_isSanFenKe()) {
            $fanCateList[] = self::F_SanFenKe;
        } elseif ($this->_isSanSeSanTongShun()) {
            $fanCateList[] = self::F_SanSeSanTongShun;
        } elseif ($this->_isSanSeSanJieGao()) {
            $fanCateList[] = self::F_SanSeSanJieGao;
        } elseif ($this->_isSanSeSanBuGao()) {
            $fanCateList[] = self::F_SanSeSanBuGao;
        }

        if ($this->_isQuanXiao()) {
            $fanCateList[] = self::F_QuanXiao;
        }
        if (empty(array_intersect([self::F_JiuLianBaoDeng, self::F_QiDui, self::F_YiSeShuangLongHui], $fanCateList))) {
            if ($this->_isQingYiSe()) {
                $fanCateList[] = self::F_QingYiSe;
            }
        }

        if ($this->_isQuanDaiWu()) {
            $fanCateList[] = self::F_QuanDaiWu;
        }
        if ($this->_isSanAnKe()) {
            $fanCateList[] = self::F_SanAnKe;
        }
        if (empty(array_intersect([self::F_QingYaoJiu], $fanCateList))) {
            if ($this->_isSanTongKe()) {
                $fanCateList[] = self::F_SanTongKe;
            }
        }

        if ($this->_isDaYvWu()) {
            $fanCateList[] = self::F_DaYvWu;
        }
        if ($this->_isXiaoYvWu()) {
            $fanCateList[] = self::F_XiaoYvWu;
        }
        if ($this->_isHuaLong()) {
            $fanCateList[] = self::F_HuaLong;
        }
        if ($this->_isTuiBuDao()) {
            $fanCateList[] = self::F_TuiBuDao;
        }
        if ($this->_isHaiDiLaoYue()) {
            $fanCateList[] = self::F_HaiDiLaoYue;
        }
        if ($this->_isMiaoShouHuiChun()) {
            $fanCateList[] = self::F_MiaoShouHuiChun;
        }
        if ($this->_isGangShangKaiHua()) {
            $fanCateList[] = self::F_GangShangKaiHua;
        }
        if ($this->_isQiangGangHu()) {
            $fanCateList[] = self::F_QiangGangHu;
        }
        if (!in_array(self::F_LvYiSe, $fanCateList)) {
            if ($this->_isHunYiSe()) {
                $fanCateList[] = self::F_HunYiSe;
            }
        }
        if (empty(array_intersect([self::F_DaSiXi, self::F_SiGang, self::F_QingYaoJiu, self::F_ZiYiSe, self::F_SiAnKe, self::F_YiSeSiJieGao, self::F_HunYaoJiu, self::F_QuanShuangKe], $fanCateList))) {
            if ($this->_isPengPengHu()) {
                $fanCateList[] = self::F_PengPengHu;
            }
        }

        if (empty(array_intersect([self::F_ShiSanYao, self::F_QiXingBuKao, self::F_ShiSanBuKao], $fanCateList))) {
            if ($this->_isWuMenQi()) {
                $fanCateList[] = self::F_WuMenQi;
            }
        }
        if ($this->_isQuanQiuRen()) {
            $fanCateList[] = self::F_QuanQiuRen;
        } elseif (empty(array_intersect([self::F_QiDui, self::F_QiXingBuKao, self::F_ShiSanBuKao], $fanCateList)) && $this->_isBuQiuRen()) {
            $fanCateList[] = self::F_BuQiuRen;
        }
        if (empty(array_intersect([self::F_SanGang], $fanCateList)) && $this->_isShuangAnGang()) {
            $fanCateList[] = self::F_ShuangAnGang;
        } elseif (empty(array_intersect([self::F_SiGang, self::F_SanGang], $fanCateList)) && $this->_isShuangMingGang()) {
            $fanCateList[] = self::F_ShuangMingGang;
        }
        if (!in_array(self::F_DaSanYuan, $fanCateList)) {
            if ($this->_isShuangJianKe()) {
                $fanCateList[] = self::F_ShuangJianKe;
            }
        }
        if (empty(array_intersect([self::F_QingYaoJiu, self::F_HunYaoJiu], $fanCateList))) {
            if ($this->_isQuanDaiYao()) {
                $fanCateList[] = self::F_QuanDaiYao;
            }
        }
        if (empty(array_intersect([self::F_QiangGangHu], $fanCateList))) {
            if ($this->_isHuJueZhang()) {
                $fanCateList[] = self::F_HuJueZhang;
            }
        }
        if (empty(array_intersect([self::F_QingYaoJiu, self::F_YiSeShuangLongHui, self::F_YiSeSiBuGao, self::F_SanSeShuangLongHui], $fanCateList))) {
            if ($this->_isPingHu()) {
                $fanCateList[] = self::F_PingHu;
            }
        }
        if (empty(array_intersect([self::F_QingYaoJiu, self::F_QuanShuangKe, self::F_QuanZhong, self::F_QuanDaiWu], $fanCateList))) {
            if ($this->_isDuanYaoJiu()) {
                $fanCateList[] = self::F_DuanYaoJiu;
            }
        }
        if (empty(array_intersect([self::F_YiSeSiTongShun], $fanCateList))) {
            if ($this->_isSiGuiYi()) {
                $fanCateList[] = self::F_SiGuiYi;
            }
        }
        if (empty(array_intersect([self::F_QingYaoJiu], $fanCateList))) {
            if ($this->_isLiangTongKe()) {
                $fanCateList[] = self::F_LiangTongKe;
            }
        }
        if (empty(array_intersect([self::F_SanAnKe], $fanCateList))) {
            if ($this->_isShuangAnKe()) {
                $fanCateList[] = self::F_ShuangAnKe;
            }
        }
        if (empty(array_intersect([self::F_ShiSanYao, self::F_SiAnKe, self::F_QiXingBuKao, self::F_ShiSanBuKao], $fanCateList))) {
            if ($this->_isMenQing()) {
                $fanCateList[] = self::F_MenQing;
            }
        }
        if (!in_array(self::F_DaSiXi, $fanCateList)) {
            if ($this->_isMenFenKe()) {
                $fanCateList[] = self::F_MenFenKe;
            }
        }
//        if(!in_array(self::F_DaSiXi,$fanCateList)){
//            if($this->_isQuanFenke()){
//                $fanCateList[] = self::F_QuanFenKe;
//            }
//        }
        if (empty(array_intersect([self::F_DaSanYuan, self::F_ShuangJianKe], $fanCateList))) {
            if ($this->_isJianke()) {
                $fanCateList[] = self::F_JianKe;
            }
        }
        if (empty(array_intersect([self::F_SanGang, self::F_ShuangAnGang], $fanCateList))) {
            if ($this->_isAnGang()) {
                $fanCateList[] = self::F_AnGang;
            }
        }


        // 般逢老连
        if (empty(array_intersect([self::F_YiSeShuangLongHui, self::F_YiSeSiTongShun, self::F_YiSeSiBuGao, self::F_SanSeShuangLongHui], $fanCateList))) {
            $sz = 0;
            $szList = [];
            foreach (self::$_splitArr as $item) {
                if (count($item) == 3 && $item[0] + 2 == $item[2]) {
                    $szList[] = $item;
                    $sz++;
                }
            }
            $s = 0;
            $logArr = [];
            if (!empty($szList)) for ($i = 0; $i < $sz; $i++) {
                for ($j = $i + 1; $j <= $sz - 1; $j++) {

                    if ($s == $sz - 1) {
                        break 2;
                    }
                    $groupArr = [$szList[$i], $szList[$j]];
                    if (empty(array_intersect([self::F_YiSeSanTongShun], $fanCateList))) {
                        if ($this->_isYiBanGao($groupArr)) {
                            if (isset($logArr[self::F_YiBanGao]) && $logArr[self::F_YiBanGao] == $groupArr) {
                                continue;
                            }
                            $fanCateList[] = self::F_YiBanGao;
                            $logArr[self::F_YiBanGao] = $groupArr;
                            $s++;
                        }
                    }
                    if ($this->_isXiXiangFen($groupArr)) {
                        if (isset($logArr[self::F_XiXiangFen]) && $logArr[self::F_XiXiangFen] == $groupArr) {
                            continue;
                        }
                        $fanCateList[] = self::F_XiXiangFen;
                        $logArr[self::F_XiXiangFen] = $groupArr;
                        $s++;
                    }
                    if (empty(array_intersect([self::F_QiDui], $fanCateList))) {
                        if (isset($logArr[self::F_LianLiu]) && $logArr[self::F_LianLiu] == $groupArr) {
                            continue;
                        }
                        if ($this->_isLianLiu($groupArr)) {
                            $fanCateList[] = self::F_LianLiu;
                            $logArr[self::F_LianLiu] = $groupArr;
                            $s++;
                        }
                    }
                    if ($this->_isLaoShaoPei($groupArr)) {
                        if (isset($logArr[self::F_LaoShaoPei]) && $logArr[self::F_LaoShaoPei] == $groupArr) {
                            continue;
                        }
                        $fanCateList[] = self::F_LaoShaoPei;
                        $logArr[self::F_LaoShaoPei] = $groupArr;
                        $s++;
                    }
                }
            }
        }


        if (empty(array_intersect([self::F_TuiBuDao], $fanCateList))) {
            if ($this->_isQueYiMen()) {
                $fanCateList[] = self::F_QueYiMen;
            }
        }
        // 箭刻不计幺九刻
        if (empty(array_intersect([self::F_DaSiXi, self::F_QingYaoJiu, self::F_XiaoSiXi, self::F_HunYaoJiu], $fanCateList))) {
            if ($this->_isYaoJiuKe()) {
                $fanCateList[] = self::F_YaoJiuKe;
            }
        }
        if (empty(array_intersect([self::F_QingYaoJiu, self::F_YiSeShuangLongHui, self::F_QingYiSe, self::F_QuanDa, self::F_QuanZhong, self::F_QuanXiao, self::F_SanSeShuangLongHui, self::F_DaYvWu, self::F_XiaoYvWu], $fanCateList))) {
            if ($this->_isWuZi()) {
                $fanCateList[] = self::F_WuZi;
            }
        }
        if (empty(array_intersect([self::F_SiGang, self::F_SanGang, self::F_ShuangMingGang], $fanCateList))) {
            if ($this->_isMingGang()) {
                $fanCateList[] = self::F_MingGang;
            }
        }

        if ($this->_isBianZhang()) {
            $fanCateList[] = self::F_BianZhang;
        } elseif ($this->_isKanZhang()) {
            $fanCateList[] = self::F_KanZhang;
        }
        if (empty(array_intersect([self::F_ShiSanYao, self::F_SiGang, self::F_QiDui, self::F_QiXingBuKao, self::F_ShiSanBuKao, self::F_QuanQiuRen], $fanCateList))) {
            if ($this->_isDanDiao()) {
                $fanCateList[] = self::F_DanDiao;
            }
        }
        if (empty(array_intersect([self::F_SiAnKe, self::F_MiaoShouHuiChun, self::F_GangShangKaiHua, self::F_BuQiuRen], $fanCateList))) {
            if ($this->_isZiMo()) {
                $fanCateList[] = self::F_ZiMo;
            }
        }

        // 一色三同顺、清龙、一色三步高、花龙、三色三同顺、三色三步高
        if (array_intersect([self::F_YiSeSanTongShun, self::F_QingLong, self::F_YiSeSanBuGao, self::F_HuaLong, self::F_SanSeSanTongShun, self::F_SanSeSanBuGao], $fanCateList)) {
            $isHasBFLL = false;

            foreach ($fanCateList as $fanName) {
                if (in_array($fanName, [self::F_YiBanGao, self::F_XiXiangFen, self::F_LaoShaoPei, self::F_LianLiu])) {
                    if ($isHasBFLL) {
                        array_splice($fanCateList, array_search($fanName, $fanCateList), 1);
                        continue;
                    }
                    $isHasBFLL = true;
                }
            }
        }

        // 无番和
        if (empty($fanCateList) && self::$_params['is_ting'] == 0) {
            $fanCateList[] = self::F_WuFanHu;
        }

        if (self::$_params['is_ting'] == 1) {
            $fanCateList[] = self::F_TingCard;
        }
        if (self::$_params['flower_count'] > 0) {
            $fanCateList[] = self::F_FlowerCard;
        }

        // 格式化番种类
        $result = [];
        $totalScore = 0;
        foreach ($fanCateList as $key => $fanName) {
            $score = Utility::recursive_array_search($fanName, self::$fanScoreMap);
            $result[$key]['fan_name'] = self::$fanNameMap[$fanName];
            if ($fanName == self::F_FlowerCard) {
                $result[$key]['score'] = self::$_params['flower_count'];
                $score = self::$_params['flower_count'];
            } else {
                $result[$key]['score'] = $score;
            }

            $totalScore += $score;
        }

        $huCards = $this->_splitCard(false);
        $huCardsFormat = [];
        array_walk_recursive($huCards, function ($value) use (&$huCardsFormat) {
            array_push($huCardsFormat, $value);
        });
        if (array_intersect($fanCateList, [self::F_ShiSanYao, self::F_LianQiDui, self::F_QiDui, self::F_QiXingBuKao, self::F_ShiSanBuKao, self::F_ZhuHeLong])) {
            $huCardsFormat = self::$_handCards;
        }
        return [
            'totalScore' => $totalScore,
            'fanList' => $result,
            'handCards' => [
                'handCards' => $huCardsFormat,
                'knownCards' => self::$_knownCards
            ]
        ];
    }






    /** =================88番start=========================== **/

    // 大四喜
    private function _isDaSiXi()
    {
        $fenCardArr = [41, 42, 43, 44];
        $s = 0;
        foreach ($fenCardArr as $card) {
            if (isset(self::$_handCardsCountMap[$card]) && self::$_handCardsCountMap[$card] >= 3) {
                $s++;
            }
        }
        if ($s == 4) {
            return true;
        }
        return false;
    }

    // 大三元
    private function _isDaSanYuan()
    {
        $fenCardArr = [45, 46, 47];
        $s = 0;
        foreach ($fenCardArr as $card) {
            if (isset(self::$_handCardsCountMap[$card]) && self::$_handCardsCountMap[$card] >= 3) {
                $s++;
            }
        }
        if ($s == 3) {
            return true;
        }
        return false;
    }

    // 十三幺
    public function _isShiSanYao()
    {
        $baseCardArr = [11, 19, 21, 29, 31, 39];
        $fenCardArr = [41, 42, 43, 44, 45, 46, 47];
        $s = 0;
        foreach ($baseCardArr as $card) {
            if (isset(self::$_handCardsCountMap[$card]) && self::$_handCardsCountMap[$card] == 1) {
                $s++;
            }
        }
        $flag = true;
        foreach ($fenCardArr as $card) {
            if (!isset(self::$_handCardsCountMap[$card])) {
                $flag = false;
                break;
            }
        }
        if ($s == 6 && $flag === true) {
            return true;
        }
        return false;
    }

    // 九莲宝灯(要求门清) 不计清一色
    private function _isJiuLianBaoDeng()
    {
        if (!$this->_isQingYiSe()) {
            return false;
        }
        if (!empty(self::$_knownCards)) {
            return false;
        }

        if (self::$_handCards[0] % 10 != 1 || self::$_handCardsCountMap[self::$_handCards[0]] < 3) {
            return false;
        } elseif (self::$_handCards[0] % 10 != 9 || self::$_handCardsCountMap[self::$_handCards[13]] < 3) {
            return false;
        }

        $cardType = $this->getCardType(self::$_handCards[0]);
        $baseCardArr = [2, 3, 4, 5, 6, 7, 8];
        $flag = true;
        foreach ($baseCardArr as $card) {
            $realCard = $cardType . $card;
            if (!isset(self::$_handCardsCountMap[$realCard])) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 连七对
    public function _isLianQiDui()
    {
        if (!$this->_isQingYiSe()) {
            return false;
        }

        $len = count(self::$_handCardsCountMap);
        if ($len != 7) {
            return false;
        }
        foreach (self::$_handCardsCountMap as $cardCount) {
            if ($cardCount != 2) {
                return false;
            }
        }
        $uniqueCards = array_keys(self::$_handCardsCountMap);
        $firstCard = $uniqueCards[0];
        $flag = true;
        for ($i = 1; $i < $len; $i++) {
            if ($firstCard != $uniqueCards[$i] - $i) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 绿一色
    private function _isLvYiSe()
    {
        $uniqueCards = array_keys(self::$_handCardsCountMap);
        $baseCardArr = [22, 23, 24, 26, 28, 46];
        if ($uniqueCards == $baseCardArr) {
            return true;
        }
        return false;
    }

    // 四杠
    private function _isSiGang()
    {
        $s = 0;
        foreach (self::$_handCardsCountMap as $cardCount) {
            if ($cardCount == 4) {
                $s++;
            }
        }
        if ($s == 4) {
            return true;
        }
        return false;
    }

    /** =================88番end=========================== **/

    /** =================64番start=========================== **/

    // 小四喜
    private function _isXiaoSiXi()
    {
        $s = 0;
        $baseCards = [41, 42, 43, 44];
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($card > 40 && $card < 45) {
                array_splice($baseCards, array_search($card, $baseCards));
                $s += $cardCount;
            }
        }
        if ($s >= 11 && empty($baseCards)) {
            return true;
        }
        return false;
    }

    // 小三元
    private function _isXiaoSanYuan()
    {
        $s = 0;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($card > 44) {
                $s += $cardCount;
            }
        }
        if ($s >= 8) {
            return true;
        }
        return false;
    }

    // 清幺九
    private function _isQingYaoJiu()
    {
        $baseCardArr = [11, 19, 21, 29, 31, 39];
        $uniqueCards = array_intersect($baseCardArr, array_keys(self::$_handCardsCountMap));
        if (count($uniqueCards) < 5) {
            return false;
        }
        $jCardCount = 0;
        $s = 0;
        foreach ($uniqueCards as $card) {
            if (isset(self::$_handCardsCountMap[$card])) {
                if (self::$_handCardsCountMap[$card] == 2) {
                    $jCardCount++;
                } elseif (self::$_handCardsCountMap[$card] >= 3) {
                    $s++;
                }
            }
        }

        if ($s == 4 && $jCardCount == 1) {
            return true;
        }
        return false;
    }

    // 一色双龙会
    private function _isYiSeShuangLongHui()
    {
        if (!$this->_isQingYiSe()) {
            return false;
        }

        $cardType = $this->getCardType(self::$_handCards[0]);
        $baseCardArr = [1, 2, 3, 5, 7, 8, 9];
        $flag = true;
        $jCardFlag = false;
        foreach ($baseCardArr as $card) {
            $realCard = $cardType . $card;

            if ($card == 5 && isset(self::$_handCardsCountMap[$realCard]) && self::$_handCardsCountMap[$realCard] == 2) {
                $jCardFlag = true;
            } else {
                if (!isset(self::$_handCardsCountMap[$realCard])) {
                    $flag = false;
                    break;
                } elseif (self::$_handCardsCountMap[$realCard] != 2) {
                    $flag = false;
                    break;
                }
            }
        }

        if ($flag === true && $jCardFlag === true) {
            return true;
        }
        return false;
    }

    // 字一色
    private function _isZiYiSe()
    {
        if (!$this->_isQingYiSe()) {
            return false;
        }

        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) != 4) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 四暗刻
    private function _isSiAnKe()
    {
        if (!empty(self::$_knownCards)) {
            return false;
        }
        if (count(array_keys(self::$_handCardsCountMap)) > 5) {
            return false;
        }
        $s = 0;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($cardCount >= 3) {
                if ($card == self::$_params['hu_card'] && self::$_params['is_zi_mo'] == 0) {
                    continue;
                }
                $s++;
            }
        }

        if ($s == 4) {
            return true;
        }
        return false;
    }

    /** =================64番end=========================== **/

    /** =================48番start=========================== **/

    // 一色四节高
    private function _isYiSeSiJieGao()
    {

        $len = count(self::$_handCardsCountMap);
        if ($len < 5) {
            return false;
        }
        $uniqueCards = array_keys(self::$_handCardsCountMap);

        $jCard = '';
        foreach ($uniqueCards as $card) {
            if (self::$_handCardsCountMap[$card] == 2) {
                $jCard = $card;
                break;
            }
        }

        array_splice($uniqueCards, array_search($jCard, $uniqueCards), 1);
        if (empty($fbHandCard)) {
            return false;
        }
        $firstCard = $uniqueCards[0];
        if (self::$_handCardsCountMap[$firstCard] < 3) {
            return false;
        }
        $flag = true;
        $tmpLen = count($uniqueCards);
        for ($i = 1; $i < $tmpLen; $i++) {
            if ($firstCard != $uniqueCards[$i] - $i || self::$_handCardsCountMap[$uniqueCards[$i]] < 3) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 一色四同顺
    private function _isYiSeSiTongShun()
    {

        $flag = true;
        if (!empty(self::$_knownCards)) foreach (self::$_knownCards as $card) {
            if (self::$_handCardsCountMap[$card[0]] >= 3) {
                $flag = false;
                break;
            }
        }
        if ($flag === false) {
            return false;
        }
        $uniqueCards = array_keys(self::$_handCardsCountMap);
        $jCard = '';
        foreach ($uniqueCards as $card) {
            if (self::$_handCardsCountMap[$card] == 2) {
                $jCard = $card;
                break;
            }
        }

        array_splice($uniqueCards, array_search($jCard, $uniqueCards), 1);
        $firstCard = $uniqueCards[0];
        if (self::$_handCardsCountMap[$firstCard] < 4) {
            return false;
        }

        $tmpLen = count($uniqueCards);
        for ($i = 1; $i < $tmpLen; $i++) {
            if ($firstCard != $uniqueCards[$i] - $i || self::$_handCardsCountMap[$uniqueCards[$i]] < 4) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    /** =================48番end=========================== **/

    /** =================32番start=========================== **/

    // 一色四步高
    private function _isYiSeSiBuGao()
    {

        $fbHandCards = self::$_handCards;
        if (!empty(self::$_knownCards)) {
            array_walk_recursive(self::$_knownCards, function ($value) use (&$fbHandCards) {
                array_push($fbHandCards, $value);
            });
            sort($fbHandCards);
        }
        $arr = [1 => 0, 2 => 0, 3 => 0];
        foreach ($fbHandCards as $card) {
            if ($this->getCardType($card) == 1) {
                $arr[1]++;
            } elseif ($this->getCardType($card) == 2) {
                $arr[2]++;
            } elseif ($this->getCardType($card) == 3) {
                $arr[3]++;
            }
        }
        $cardType = $arr[1] > $arr[2] ? ($arr[1] > $arr[3] ? 1 : 3) : ($arr[2] > $arr[3] ? 2 : 3);

        $list = [];
        foreach (self::$_splitArr as $item) {
            if (count($item) == 3 && $this->getCardType($item[0]) == $cardType && $item[0] + 2 == $item[2]) {
                $list[] = $item;
            }
        }
        $len = count($list);
        if ($len < 4) {
            return false;
        }

        $s = 1;
        for ($i = 0; $i < $len; $i++) {
            $key = $list[$i][0];
            $s = 1;
            for ($j = $i + 1; $j < $len; $j++) {

                if ($key + 1 == $list[$j][0]) {
                    $key = $list[$j][0];
                    $s++;
                }
            }
            if ($s == 4) {
                break;
            }
        }
        if ($s < 4) {
            $s = 1;
            for ($i = 0; $i < $len; $i++) {
                $key = $list[$i][0];
                $s = 1;
                for ($j = $i + 1; $j < $len; $j++) {

                    if ($key + 2 == $list[$j][0]) {
                        $key = $list[$j][0];
                        $s++;
                    }
                }
                if ($s == 4) {
                    break;
                }
            }
        }

        if ($s == 4) {
            return true;
        }
        return false;
    }

    // 混幺九
    private function _isHunYaoJiu()
    {
        $uniqueCards = array_keys(self::$_handCardsCountMap);
        $flag = true;
        $jCardCount = 0;
        $s = 0;
        foreach ($uniqueCards as $card) {
            if ($card % 10 != 1 || $card % 10 != 9) {
                if ($this->getCardType($card) != 4) {
                    $flag = false;
                    break;
                }
            }
            if (self::$_handCardsCountMap[$card] == 3) {
                $s++;
            } elseif (self::$_handCardsCountMap[$card] == 2) {
                $jCardCount++;
            }
        }
        if ($flag === false) {
            return false;
        }
        if ($s == 4 && $jCardCount == 1) {
            return true;
        }
        return false;
    }

    // 三杠
    private function _isSanGang()
    {

        $s = 0;
        if (!empty(self::$_knownCards)) foreach (self::$_knownCards as $item) {
            if (count($item) == 4 && $item[0] == $item[3]) {
                $s++;
            }
        }
        if ($s == 3) {
            return true;
        }
        return false;
    }

    /** =================32番end=========================== **/

    /** =================24番start=========================== **/

    // 七对
    public function _isQiDui()
    {

        $flag = true;
        foreach (self::$_handCardsCountMap as $cardCount) {
            if ($cardCount != 2) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 七星不靠
    public function _isQiXingBuKao()
    {

        $fenCardArr = [41, 42, 43, 44, 45, 46, 47];
        $baseCardArr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $flag = true;
        foreach ($fenCardArr as $card) {
            if (!isset(self::$_handCardsCountMap[$card])) {
                $flag = false;
                break;
            }
        }

        if ($flag === false) {
            return false;
        }

        $fbHandCards = self::$_handCards;
        while ($card = array_shift($fenCardArr)) {
            array_splice($fbHandCards, array_search($card, $fbHandCards), 1);
        }

        if (count($fbHandCards) != 7) {
            return false;
        }

        $list = [];
        foreach ($fbHandCards as $card) {
            $list[$this->getCardType($card)][] = $card;
        }

        $flag = true;
        foreach ($list as $item) {

            foreach ($item as $key => $card) {
                if (in_array($card % 10, $baseCardArr)) {
                    array_splice($baseCardArr, array_search($card % 10, $baseCardArr), 1);
                } else {
                    $flag = false;
                    break;
                }
                if ($key == 0) {
                    $lastCard = $card;
                    continue;
                }
                if ($lastCard + 3 != $card && $lastCard + 6 != $card) {
                    $flag = false;
                    break;
                }
            }
            if ($flag === false) {
                break;
            }
        }
        return $flag;
    }

    // 全双刻
    private function _isQuanShuangKe()
    {
        $flag = true;
        $s = 0;
        $jCardCount = 0;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) > 3) {
                $flag = false;
                break;
            }
            if ($card % 10 % 2 == 0) {
                if ($cardCount >= 3) {
                    $s++;
                } elseif ($cardCount == 2) {
                    $jCardCount++;
                }
            }
        }

        if ($flag === false) {
            return false;
        }
        if ($s == 4 && $jCardCount == 1) {
            return true;
        }
        return false;
    }

    // 全大
    private function _isQuanDa()
    {
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) > 3 || !in_array($card % 10, [7, 8, 9])) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 全中
    private function _isQuanZhong()
    {
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) > 3 || !in_array($card % 10, [4, 5, 6])) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 全小
    private function _isQuanXiao()
    {
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) > 3 || !in_array($card % 10, [1, 2, 3])) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 一色三节高
    private function _isYiSeSanJieGao()
    {

        $list = [];
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) <= 3 && $cardCount >= 3) {
                $list[] = $card;
            }
        }
        $tmpLen = count($list);
        if ($tmpLen < 3) {
            return false;
        }

        $lastCard = $list[0];
        $arr = [$list[0]];
        for ($i = 1; $i < $tmpLen; $i++) {
            if (count($arr) == 3) {
                break;
            }
            if ($list[$i] - $lastCard == 1) {
                $arr[] = $list[$i];
            } else {
                $arr = [];
                $arr[] = $list[$i];
            }
            $lastCard = $list[$i];
        }

        if (count($arr) < 3) {
            return false;
        }

        $flag = true;
        foreach (self::$_knownCards as $item) {
            if ($item == $arr) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 一色三同顺
    private function _isYiSeSanTongShun()
    {
        $list = [];
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) <= 3 && $cardCount >= 3) {
                $list[] = $card;
            }
        }
        $tmpLen = count($list);
        if ($tmpLen < 3) {
            return false;
        }

        $lastCard = $list[0];
        $arr = [$list[0]];
        for ($i = 1; $i < $tmpLen; $i++) {
            if (count($arr) == 3) {
                break;
            }
            if ($list[$i] - $lastCard == 1) {
                $arr[] = $list[$i];
            } else {
                $arr = [];
                $arr[] = $list[$i];
            }
            $lastCard = $list[$i];
        }

        if (count($arr) < 3) {
            return false;
        }

        $flag = true;
        $knownCardsCountMap = [];
        array_walk_recursive(self::$_knownCards, function ($value) use (&$knownCardsCountMap) {
            array_push($knownCardsCountMap, $value);
        });
        $knownCardsCountMap = array_count_values($knownCardsCountMap);
        foreach ($arr as $card) {
            if (isset($knownCardsCountMap[$card]) && $knownCardsCountMap[$card] >= 3) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 清一色
    private function _isQingYiSe()
    {
        $cardType = $this->getCardType(self::$_handCards[0]);
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($cardType != $this->getCardType($card)) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    /** =================24番end=========================== **/

    /** =================16番start=========================== **/

    // 青龙
    private function _isQingLong()
    {
        $baseCardArr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $arr = [1 => 0, 2 => 0, 3 => 0];
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) == 1) {
                $arr[1]++;
            } elseif ($this->getCardType($card) == 2) {
                $arr[2]++;
            } elseif ($this->getCardType($card) == 3) {
                $arr[3]++;
            }
        }
        $cardType = $arr[1] > $arr[2] ? ($arr[1] > $arr[3] ? 1 : 3) : ($arr[2] > $arr[3] ? 2 : 3);

        $fbHandCards = self::$_handCards;
        if (!empty(self::$_knownCards)) {
            array_walk_recursive(self::$_knownCards, function ($value) use (&$fbHandCards) {
                array_push($fbHandCards, $value);
            });
            sort($fbHandCards);
        }

        while ($card = array_shift($baseCardArr)) {
            $realCard = $cardType . $card;
            $idx = array_search($realCard, $fbHandCards);
            if ($idx === false) {
                return false;
            }
            array_splice($fbHandCards, $idx, 1);
        }
        if (count($fbHandCards) > 6) {
            return false;
        }
        $fbHandCardsCountMap = array_count_values($fbHandCards);
        $jCard = '';
        foreach ($fbHandCardsCountMap as $card => $cardValue) {
            if ($cardValue == 2) {
                $jCard = $card;
                break;
            }
        }
        if (empty($jCard)) {
            return false;
        }
        array_splice($fbHandCards, array_search($jCard, $fbHandCards), 2);

        $flag = false;
        if (count($fbHandCards) == 4 && $fbHandCards[0] == $fbHandCards[3]) {
            $flag = true;
        } elseif (count($fbHandCards) == 3) {
            if ($fbHandCards[0] == $fbHandCards[2]) {
                $flag = true;
            } elseif ($fbHandCards[2] - 2 == $fbHandCards[0]) {
                $flag = true;
            }
        }
        return $flag;
    }

    // 一色三步高
    private function _isYiSeSanBuGao()
    {

        $fbHandCards = self::$_handCards;
        if (!empty(self::$_knownCards)) {
            array_walk_recursive(self::$_knownCards, function ($value) use (&$fbHandCards) {
                array_push($fbHandCards, $value);
            });
            sort($fbHandCards);
        }

        $arr = [1 => 0, 2 => 0, 3 => 0];
        foreach ($fbHandCards as $card) {
            if ($this->getCardType($card) == 1) {
                $arr[1]++;
            } elseif ($this->getCardType($card) == 2) {
                $arr[2]++;
            } elseif ($this->getCardType($card) == 3) {
                $arr[3]++;
            }
        }
        $cardType = $arr[1] > $arr[2] ? ($arr[1] > $arr[3] ? 1 : 3) : ($arr[2] > $arr[3] ? 2 : 3);

        $list = [];
        foreach (self::$_splitArr as $item) {
            if (count($item) == 3 && $this->getCardType($item[0]) == $cardType && $item[0] + 2 == $item[2]) {
                $list[] = $item;
            }
        }
        $len = count($list);
        if ($len < 3) {
            return false;
        }

        $s = 1;
        for ($i = 0; $i < $len; $i++) {
            $key = $list[$i][0];
            $s = 1;
            for ($j = $i + 1; $j < $len; $j++) {

                if ($key + 1 == $list[$j][0]) {
                    $key = $list[$j][0];
                    $s++;
                }
            }
            if ($s >= 3) {
                break;
            }
        }
        if ($s < 3) {
            $s = 1;
            for ($i = 0; $i < $len; $i++) {
                $key = $list[$i][0];
                $s = 1;
                for ($j = $i + 1; $j < $len; $j++) {

                    if ($key + 2 == $list[$j][0]) {
                        $key = $list[$j][0];
                        $s++;
                    }
                }
                if ($s >= 3) {
                    break;
                }
            }
        }

        if ($s == 3) {
            return true;
        }
        return false;
    }

    // 全带五
    private function _isQuanDaiWu()
    {

        $fbHandCards = self::$_handCards;
        if (!empty(self::$_knownCards)) {
            array_walk_recursive(self::$_knownCards, function ($value) use (&$fbHandCards) {
                array_push($fbHandCards, $value);
            });
            sort($fbHandCards);
        }

        if (array_intersect([41, 42, 43, 44, 45, 46, 47], self::$_handCards)) {
            return false;
        }

        $jCardList = [];
        $len = count($fbHandCards);
        for ($i = 0; $i < $len - 1; $i++) {
            if ($fbHandCards[$i] == $fbHandCards[$i + 1] && !isset($jCardList[$fbHandCards[$i]])) {
                $jCardList[$fbHandCards[$i]] = [$fbHandCards[$i], $fbHandCards[$i]];
                $i++;
            }
        }

        while ($jCard = array_shift($jCardList)) {
            $fbHandCard = $fbHandCards;
            $idx = array_search($jCard[0], $fbHandCard);
            array_splice($fbHandCard, $idx, 2);
            $isHu = $this->analyseCards($fbHandCard);
            if ($isHu) {
                $jCard = $jCard[0];
                break;
            }
        }

        array_splice($fbHandCards, array_search($jCard, $fbHandCards), 2);

        foreach (self::$_knownCards as $item) {
            $result[] = $item;
        }
        $this->_sortCard($fbHandCards, $result);
        if (count($fbHandCards) == 2) {
            $result[] = $fbHandCards;
        }

        $result[] = [$jCard, $jCard];

        foreach ($result as $item) {
            $s = 0;
            while ($card = array_shift($item)) {
                if ($card % 10 == 5) {
                    $s++;
                    break;
                }
            }
            if ($s == 0) {
                return false;
            }
        }
        return true;
    }

    // 三色双龙会
    private function _isSanSeShuangLongHui()
    {

        $jCard = array_search(2, self::$_handCardsCountMap);
        if (!in_array($jCard, [15, 25, 35])) {
            return false;
        }

        $fbHandCards = self::$_handCards;
        if (!empty(self::$_knownCards)) {
            array_walk_recursive(self::$_knownCards, function ($value) use (&$fbHandCards) {
                array_push($fbHandCards, $value);
            });
            sort($fbHandCards);
        }
        $i = 2;
        $typeArr = [0, 0];
        $n = 0;
        while ($i--) {
            $cType = $this->getCardType($fbHandCards[0]);
            $typeArr[$n] = $cType;
            $baseCardArr = [1, 2, 3, 7, 8, 9];
            while ($cardValue = array_shift($baseCardArr)) {
                $idx = array_search($cType . $cardValue, $fbHandCards);
                if ($idx === false) {
                    $flag = false;
                    break;
                }
                array_splice($fbHandCards, $idx, 1);
            }
            if (isset($flag) && $flag === false) {
                return false;
            }
            $n++;
        }

        $typeArr[] = $this->getCardType($jCard);
        if (empty(array_diff($typeArr, [1, 2, 3]))) {
            return true;
        }
        return false;
    }

    // 三暗刻
    private function _isSanAnKe()
    {
        $jCardList = [];
        $fbHandCards = self::$_handCards;

        $len = count($fbHandCards);
        for ($i = 0; $i < $len - 1; $i++) {
            if ($fbHandCards[$i] == $fbHandCards[$i + 1] && !isset($jCardList[$fbHandCards[$i]])) {
                $jCardList[$fbHandCards[$i]] = [$fbHandCards[$i], $fbHandCards[$i]];
                $i++;
            }
        }

        while ($jCard = array_shift($jCardList)) {
            $fbHandCard = $fbHandCards;
            $idx = array_search($jCard[0], $fbHandCard);
            array_splice($fbHandCard, $idx, 2);
            $isHu = $this->analyseCards($fbHandCard);
            if ($isHu) {
                $jCard = $jCard[0];
                break;
            }
        }

        array_splice($fbHandCards, array_search($jCard, $fbHandCards), 2);
        $this->_sortCard($fbHandCards, $result);

        $s = 0;
        if (!empty($result)) foreach ($result as $item) {
            if ($item[0] == $item[2]) {
                $s++;
            }
        }

        if ($s >= 3) {
            return true;
        }
        return false;
    }

    // 三同刻
    private function _isSanTongKe()
    {
        $jCardList = [];
        $fbHandCards = self::$_handCards;
        if (!empty(self::$_knownCards)) {
            array_walk_recursive(self::$_knownCards, function ($value) use (&$fbHandCards) {
                array_push($fbHandCards, $value);
            });
            sort($fbHandCards);
        }
        $len = count($fbHandCards);
        for ($i = 0; $i < $len - 1; $i++) {
            if ($fbHandCards[$i] == $fbHandCards[$i + 1] && !isset($jCardList[$fbHandCards[$i]])) {
                $jCardList[$fbHandCards[$i]] = [$fbHandCards[$i], $fbHandCards[$i]];
                $i++;
            }
        }

        while ($jCard = array_shift($jCardList)) {
            $fbHandCard = $fbHandCards;
            $idx = array_search($jCard[0], $fbHandCard);
            array_splice($fbHandCard, $idx, 2);
            $isHu = $this->analyseCards($fbHandCard);
            if ($isHu) {
                $jCard = $jCard[0];
                break;
            }
        }

        array_splice($fbHandCards, array_search($jCard, $fbHandCards), 2);
        $this->_sortCard($fbHandCards, $result);
        $flag = false;
        if (!empty($result)) foreach ($result as $item) {
            if ($item[0] == $item[2] && in_array($this->getCardType($item[0]), [1, 2, 3])) {
                if (!isset($arr[$item[0] % 10])) {
                    $arr[$item[0] % 10] = 1;
                } else {
                    $arr[$item[0] % 10]++;
                }
                if ($arr[$item[0] % 10] >= 3) {
                    $flag = true;
                    break;
                }
            }
        }
        return $flag;
    }

    /** =================16番end=========================== **/

    /** =================12番start=========================== **/

    // 十三不靠
    public function _isShiSanBuKao()
    {
        $fbHandCards = self::$_handCards;

        if (count($fbHandCards) != 14) {
            return false;
        }
        $baseCardArr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $flag = true;
        $fenCardCount = 0;
        foreach ($fbHandCards as $card) {
            if ($this->getCardType($card) == 4) {
                if (self::$_handCardsCountMap[$card] > 1) {
                    $flag = false;
                    break;
                }
                $fenCardCount++;
                array_splice($fbHandCards, array_search($card, $fbHandCards), 1);
            }
        }

        if ($flag === false || $fenCardCount < 5) {
            return false;
        }

        $list = [];
        foreach ($fbHandCards as $card) {
            $list[$this->getCardType($card)][] = $card;
        }

        $flag = true;
        foreach ($list as $item) {

            foreach ($item as $key => $card) {
                if (in_array($card % 10, $baseCardArr)) {
                    array_splice($baseCardArr, array_search($card % 10, $baseCardArr), 1);
                } else {
                    $flag = false;
                    break;
                }
                if ($key == 0) {
                    $lastCard = $card;
                    continue;
                }
                if ($lastCard + 3 != $card && $lastCard + 6 != $card) {
                    $flag = false;
                    break;
                }
            }
            if ($flag === false) {
                break;
            }
        }

        return $flag;
    }

    // 组合龙(必须门清，不能吃碰,和牌须自摸)
    public function _isZhuHeLong()
    {
        if (count(self::$_knownCards) > 1) {
            return false;
        } elseif (count(self::$_knownCards) == 1) {
            if (count(self::$_knownCards[0]) != 4) {
                return false;
            }
        }

        $isGang = false;
        if (!empty(count(self::$_knownCards))) {
            $isGang = true;
        }

        $fbHandCards = self::$_handCards;
        $len = count($fbHandCards);
        for ($i = 0; $i < $len - 1; $i++) {
            if ($fbHandCards[$i] == $fbHandCards[$i + 1] && !isset($jCardList[$fbHandCards[$i]])) {
                $jCardList[$fbHandCards[$i]] = [$fbHandCards[$i], $fbHandCards[$i]];
                $i++;
            }
        }
        $flag = false;
        $arr = [[1, 4, 7], [2, 5, 8], [3, 6, 9]];
        if (empty($jCardList)) {
            return $flag;
        }
        while ($jCard = array_shift($jCardList)) {
            $fbHandCard = $fbHandCards;
            $fbArr = $arr;
            $idx = array_search($jCard[0], $fbHandCard);
            array_splice($fbHandCard, $idx, 2);
            $list = [];
            foreach ($fbHandCard as $card) {
                $list[$this->getCardType($card)][] = $card;
            }

            foreach ($list as $item) {
                $curCardType = $this->getCardType($item[0]);
                if ($curCardType > 3) {
                    continue;
                }

                foreach ($fbArr as $key => $group) {
                    $s = 0;
                    foreach ($group as $v) {
                        if (in_array($curCardType . $v, $item)) {
                            $s++;
                            if ($s == 3) {
                                break;
                            }
                        }
                    }

                    if ($s == 3) {
                        while ($cardValue = array_shift($fbArr[$key])) {
                            $realCard = $curCardType . $cardValue;
                            array_splice($fbHandCard, array_search($realCard, $fbHandCard), 1);
                        }
                        unset($fbArr[$key]);
                        break;
                    }
                }
                if ($s < 3) {
                    break;
                }
            }

            if (empty($fbHandCard)) {
                $flag = true;
                break;
            }

            if (count($fbArr) > 0) {
                continue;
            }

            if (!$isGang) {
                $validCard = [];
                $len = count($fbHandCard);
                for ($i = 0; $i < $len; $i++) {
                    if (isset($fbHandCard[$i + 2]) && $fbHandCard[$i] == $fbHandCard[$i + 2]) {
                        $validCard = [$fbHandCard[$i], $fbHandCard[$i + 1], $fbHandCard[$i + 2]];
                        break;
                    } else {

                        if (in_array($fbHandCard[$i] + 1, $fbHandCard) && in_array($fbHandCard[$i] + 2, $fbHandCard)) {
                            $validCard = [$fbHandCard[$i], $fbHandCard[$i] + 1, $fbHandCard[$i] + 2];
                            break;
                        }
                    }
                }

                if (!empty($validCard)) {
                    while ($card = array_shift($validCard)) {
                        array_splice($fbHandCard, array_search($card, $fbHandCard), 1);
                    }
                }

                if (empty($fbHandCard)) {
                    $flag = true;
                    break;
                }
            }
        }
        return $flag;
    }

    // 大于五
    private function _isDaYvWu()
    {
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) > 3 || !in_array($card % 10, [6, 7, 8, 9])) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 小于五
    private function _isXiaoYvWu()
    {
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) > 3 || !in_array($card % 10, [1, 2, 3, 4])) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 三风刻
    private function _isSanFenKe()
    {
        $s = 0;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($this->getCardType($card) == 4 && $cardCount >= 3) {
                $s++;
            }
        }
        if ($s == 3) {
            return true;
        }
        return false;
    }

    /** =================12番end=========================== **/

    /** =================8番start=========================== **/

    // 花龙
    private function _isHuaLong()
    {
        $result = self::$_splitArr;
        $arr = [1, 4, 7];
        $typeArr = [];
        while ($cardValue = array_shift($arr)) {
            foreach ($result as $item) {
                if (count($item) != 3) {
                    continue;
                }
                if ($item[0] + 2 != $item[2]) {
                    continue;
                }
                if ($cardValue == $item[0] % 10 && $cardValue + 2 == $item[2] % 10) {
                    $typeArr[$this->getCardType($item[0])][] = $item[0];
                }
            }
        }

        $tmpArr = [];
        array_walk_recursive($typeArr, function ($value) use (&$tmpArr) {
            array_push($tmpArr, $value);
        });

        $groupArr = [];
        if (empty(array_diff([1, 2, 3], array_keys($typeArr)))) {

            for ($i = 0; $i < count($tmpArr); $i++) {
                $groupArr[$this->getCardType($tmpArr[$i])] = $tmpArr[$i] % 10;
                for ($j = $i + 1; $j <= count($tmpArr) - 1; $j++) {
                    if (!isset($groupArr[$this->getCardType($tmpArr[$j])]) && !in_array($tmpArr[$j] % 10, $groupArr)) {
                        $groupArr[$this->getCardType($tmpArr[$j])] = $tmpArr[$j] % 10;
                    }
                }
                if (count($groupArr) == 3) {
                    if (empty(array_diff([1, 4, 7], $groupArr)) && empty(array_diff([1, 2, 3], array_keys($groupArr)))) {
                        return true;
                    }
                }

                if (count($groupArr) < 3) {
                    $groupArr = [];
                }
            }
        }

        if (empty(array_diff([1, 4, 7], $groupArr))) {
            return true;
        }
        return false;
    }

    // 推不倒
    private function _isTuiBuDao()
    {
        $baseCardArr = [22, 24, 25, 26, 28, 29, 31, 32, 33, 34, 35, 38, 39, 47];
        $flag = true;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if (!in_array($card, $baseCardArr)) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 三色三同顺
    private function _isSanSeSanTongShun()
    {

        $result = self::$_splitArr;
        $list = [];
        foreach ($result as $item) {
            if (count($item) == 3 && $item[0] + 2 == $item[2]) {
                $list[$this->getCardType($item[0])][] = $item[0] % 10;
            }
        }
        $diffArr = array_diff([1, 2, 3], array_keys($list));
        if (!empty($diffArr)) {
            return false;
        }

        if (!empty($list[1]) && !empty($list[2]) && !empty($list[3])) {
            if (array_intersect($list[1], $list[2], $list[3])) {
                return true;
            }
        }
        return false;
    }

    // 三色三节高
    private function _isSanSeSanJieGao()
    {
        $result = self::$_splitArr;
        $list = [];
        foreach ($result as $item) {
            if (count($item) == 3 && $item[0] == $item[2]) {
                $list[$this->getCardType($item[0])][] = $item[0] % 10;
            }
        }
        $diffArr = array_diff([1, 2, 3], array_keys($list));
        if (!empty($diffArr)) {
            return false;
        }

        $arr = [];
        array_walk_recursive($list, function ($value) use (&$arr) {
            array_push($arr, $value);
        });

        sort($arr);
        $lastCard = $arr[0];
        $tmpArr = [$lastCard];
        for ($i = 1; $i < count($arr); $i++) {
            if (count($tmpArr) == 3) {
                break;
            }
            if ($arr[$i] == $lastCard) {
                continue;
            }
            if ($arr[$i] - 1 != $lastCard) {
                $tmpArr = [];
                $lastCard = $arr[$i];
                $tmpArr[] = $lastCard;
            } else {
                $tmpArr[] = $arr[$i];
                $lastCard = $arr[$i];
            }
        }

        if (count($tmpArr) == 3) {
            $typeArr = [];
            foreach ($tmpArr as $v) {
                foreach ($list as $key => $item) {
                    if (in_array($v, $item) && !in_array($key, array_keys($typeArr))) {
                        $typeArr[$key] = $v;
                        break;
                    }
                }
            }

            if (count($typeArr) == 3) {
                return true;
            }
        }
        return false;
    }

    // 无番和（不可报听和自摸）
    private function _isWuFanHu()
    {
        if (self::$_params['is_ting'] == 1 || self::$_params['is_zi_mo'] == 1) {
            return false;
        }
    }

    // 海底捞月
    private function _isHaiDiLaoYue()
    {
        if (self::$_params['is_last_card'] == 1 && self::$_params['is_zi_mo'] == 0) {
            return true;
        }
        return false;
    }

    // 妙手回春(不重复计算自摸)
    private function _isMiaoShouHuiChun()
    {
        if (self::$_params['is_last_card'] == 1 && self::$_params['is_zi_mo'] == 1) {
            return true;
        }
        return false;
    }

    // 杠上开花
    private function _isGangShangKaiHua()
    {
        if (self::$_params['is_gang_mo_pai'] == 1) {
            return true;
        }
        return false;
    }

    // 抢杠和
    private function _isQiangGangHu()
    {
        return self::$_params['is_qiang_gang_hu'] == 1 ? true : false;
    }

    /** =================8番end=========================== **/

    /** =================6番start=========================== **/

    // 混一色
    private function _isHunYiSe()
    {
        $list = [];
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            $cardType = $this->getCardType($card);
            if (!in_array($cardType, $list)) {
                $list[] = $cardType;
            }
        }
        if (count($list) == 2 && in_array(4, $list)) {
            return true;
        }
        return false;
    }


    // 碰碰和
    private function _isPengPengHu()
    {
        $uniqueCards = array_keys(self::$_handCardsCountMap);
        $cardUniqueCount = count($uniqueCards);

        if ($cardUniqueCount == 5) {
            $s = 0;
            foreach ($uniqueCards as $card) {
                if (self::$_handCardsCountMap[$card] >= 3) {
                    $s++;
                }
            }
            if ($s == 4) {
                return true;
            }
        }
        return false;
    }

    // 三色三步高
    private function _isSanSeSanBuGao()
    {

        $result = self::$_splitArr;

        $list = [];
        foreach ($result as $item) {
            if (count($item) == 3 && $item[0] + 2 == $item[2]) {
                $list[$this->getCardType($item[0])][] = $item[0] % 10;
            }
        }

        $diffArr = array_diff([1, 2, 3], array_keys($list));
        if (!empty($diffArr)) {
            return false;
        }

        $arr = [];
        array_walk_recursive($list, function ($value) use (&$arr) {
            array_push($arr, $value);
        });

        sort($arr);
        $lastCard = $arr[0];
        $tmpArr = [$lastCard];
        for ($i = 1; $i < count($arr); $i++) {
            if (count($tmpArr) == 3) {
                break;
            }
            if ($arr[$i] == $lastCard) {
                continue;
            }
            if ($arr[$i] - 1 != $lastCard) {
                $tmpArr = [];
                $lastCard = $arr[$i];
                $tmpArr[] = $lastCard;
            } else {
                $tmpArr[] = $arr[$i];
                $lastCard = $arr[$i];
            }
        }
        if (count($tmpArr) == 3) {
            $typeArr = [];
            foreach ($tmpArr as $v) {
                foreach ($list as $key => $item) {
                    if (in_array($v, $item) && !in_array($key, array_keys($typeArr))) {
                        $typeArr[$key] = $v;
                        break;
                    }
                }
            }
            if (count($typeArr) == 3) {
                return true;
            }
        }
        return false;
    }

    // 五门齐
    private function _isWuMenQi()
    {

        $typeArr = [];
        $fenCardCount = $jianCardCount = 0;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            $cardType = $this->getCardType($card);
            if ($cardType < 4 && !in_array($cardType, $typeArr)) {
                $typeArr[] = $cardType;
            }
            if ($cardType == 4) {
                if (in_array($card, [41, 42, 43, 44])) {
                    $fenCardCount++;
                } elseif (in_array($card, [45, 46, 47])) {
                    $jianCardCount++;
                }
            }
        }

        if (count($typeArr) == 3 && $fenCardCount > 0 && $jianCardCount > 0) {
            return true;
        }
        return false;
    }

    // 全求人
    private function _isQuanQiuRen()
    {
        if (count(self::$_handCards) == 2 && self::$_handCards[0] == self::$_handCards[1]) {
            if (self::$_params['an_gang_count'] == 0 && self::$_params['is_zi_mo'] == 0) {
                return true;
            }
        }
        return false;
    }

    // 双暗杠
    private function _isShuangAnGang()
    {
        if (self::$_params['an_gang_count'] == 2) {
            return true;
        }
        return false;
    }

    // 双箭刻
    private function _isShuangJianKe()
    {
        $s = 0;
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if (in_array($card, [45, 46, 47]) && $cardCount >= 3) {
                $s++;
            }
        }
        if ($s == 2) {
            return true;
        }
        return false;
    }
    /** =================6番end=========================== **/

    /** =================4番start=========================== **/

    // 全带幺
    private function _isQuanDaiYao()
    {
        $result = self::$_splitArr;
        if (empty($result)) {
            return false;
        }
        $flag = true;
        foreach ($result as $item) {
            $intersectArr = array_intersect($item, [11, 19, 21, 29, 31, 39, 41, 42, 43, 44, 45, 46, 47]);
            if (empty($intersectArr)) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    // 不求人
    private function _isBuQiuRen()
    {
        if (empty(self::$_knownCards) && self::$_params['is_zi_mo'] == 1) {
            return true;
        } elseif (!empty(self::$_knownCards)) {
            if (count(self::$_knownCards) == self::$_params['an_gang_count'] && self::$_params['is_zi_mo'] == 1) {
                return true;
            }
        }
        return false;
    }

    // 双明杠
    private function _isShuangMingGang()
    {
        if (self::$_params['ming_gang_count'] == 2) {
            return true;
        }
        return false;
    }

    // 和绝张
    private function _isHuJueZhang()
    {
        return self::$_params['is_hu_jue_zhang'] == 1 ? true : false;
    }

    /** =================4番end=========================== **/

    /** =================2番start=========================== **/

    // 平和
    private function _isPingHu()
    {
        $result = self::$_splitArr;
        $s = 0;
        $jCardFlag = false;
        foreach ($result as $item) {
            if (count($item) > 3) {
                return false;
            }
            if (count($item) == 3 && $item[0] + 2 == $item[2]) {
                $s++;
            } elseif (count($item) == 2) {
                if (in_array($this->getCardType($item[0]), [1, 2, 3])) {
                    $jCardFlag = true;
                }
            }
        }

        if ($s == 4 && $jCardFlag === true) {
            return true;
        }
        return false;
    }

    // 断幺九
    private function _isDuanYaoJiu()
    {
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if (in_array($card, [11, 19, 21, 29, 31, 39, 41, 42, 43, 44, 45, 46, 47])) {
                return false;
            }
        }
        return true;
    }

    // 四归一
    private function _isSiGuiYi()
    {
        $key = '';
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($cardCount == 4) {
                $key = $card;
                break;
            }
        }
        if (empty($key)) {
            return false;
        }
        $flag = true;
        if (!empty(self::$_knownCards)) foreach (self::$_knownCards as $item) {
            if (count($item) == 4 && $item[0] == $key) {
                $flag = false;
                break;
            }
        }
        if (!empty($key) && $flag === true) {
            return true;
        }
        return false;
    }

    // 两同刻
    private function _isLiangTongKe()
    {
        $result = self::$_splitArr;
        $list = [];
        foreach ($result as $item) {
            if (count($item) >= 3 && $this->getCardType($item[0]) < 4 && $item[0] == $item[2]) {
                $list[] = $item[0] % 10;
            }
        }
        $tmpArr = array_count_values($list);
        foreach ($tmpArr as $c) {
            if ($c == 2) {
                return true;
            }
        }
        return false;
    }

    // 双暗刻
    private function _isShuangAnKe()
    {
        $result = $this->_splitCard(false);
        $s = 0;
        $tmpArr = [];
        foreach ($result as $item) {
            if (count($item) == 3 && $item[0] == $item[2]) {
                $tmpArr[] = $item[0] % 10;
                $s++;
            }
        }
        // 双同刻和双暗刻不重复计番
        if ($s == 2 && $tmpArr[0] != $tmpArr[1]) {
            return true;
        }
        return false;
    }

    // 门清
    private function _isMenQing()
    {
        if (empty(self::$_knownCards) && self::$_params['is_zi_mo'] == 0) {
            return true;
        } elseif (!empty(self::$_knownCards)) {
            if (count(self::$_knownCards) == self::$_params['an_gang_count'] && self::$_params['is_zi_mo'] == 0) {
                return true;
            }
        }
        return false;
    }

    // 门风刻
    private function _isMenFenKe()
    {
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($cardCount >= 3 && $card == self::$_params['men_fen'] + 40) {
                return true;
            }
        }
        return false;
    }

    // 圈风刻
    private function _isQuanFenke()
    {
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($cardCount >= 3 && $card == self::$_params['quan_fen'] + 40) {
                return true;
            }
        }
        return false;
    }

    // 箭刻
    private function _isJianKe()
    {
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            if ($cardCount >= 3 && $card >= 45 && $card <= 47) {
                return true;
            }
        }
        return false;
    }

    // 暗杠
    private function _isAnGang()
    {
        return self::$_params['an_gang_count'] > 0 ? true : false;
    }

    /** =================2番end=========================== **/

    /** =================1番start=========================== **/

    // 一般高
    private function _isYiBanGao($cardList = [])
    {

        $result = empty($cardList) ? self::$_splitArr : $cardList;

        $list = [];
        foreach ($result as $item) {
            if (count($item) == 3 && $item[0] + 2 == $item[2]) {
                $list[] = $item;
            }
        }
        if (count($list) < 2) {
            return false;
        }

        for ($i = 0; $i < count($list); $i++) {
            for ($j = $i + 1; $j <= count($list) - 1; $j++) {
                if ($list[$i] == $list[$j]) {
                    return true;
                }
            }
        }
        return false;
    }

    // 喜相逢
    private function _isXiXiangFen($cardList = [])
    {
        $result = empty($cardList) ? self::$_splitArr : $cardList;
        $list = [];
        foreach ($result as $item) {
            if (count($item) == 3 && $item[0] + 2 == $item[2]) {
                $list[$this->getCardType($item[0])][] = $item[0] % 10;
            }
        }
        $intersectArr = array_intersect([1, 2, 3], array_keys($list));
        if (!empty($intersectArr) && count($intersectArr) < 2) {
            return false;
        }

        $list = array_values($list);
        for ($i = 0; $i < count($list); $i++) {
            for ($j = $i + 1; $j <= count($list) - 1; $j++) {
                if (array_intersect($list[$i], $list[$j])) {
                    return true;
                }
            }
        }
        return false;
    }

    // 连六
    private function _isLianLiu($cardList = [])
    {
        $result = empty($cardList) ? self::$_splitArr : $cardList;
        $list = [];
        foreach ($result as $item) {
            $list[$this->getCardType($item[0])][] = $item[0];
        }

        foreach ($list as $item) {
            if (count($item) >= 2) {
                if ($item[0] + 3 == $item[1]) {
                    return true;
                }
            }
        }
        return false;
    }

    // 老少配
    private function _isLaoShaoPei($cardList = [])
    {
        $result = empty($cardList) ? self::$_splitArr : $cardList;
        $list = [];
        foreach ($result as $item) {
            $list[$this->getCardType($item[0])][] = $item[0] % 10;
        }

        foreach ($list as $item) {
            if (count($item) >= 2) {
                if (array_intersect($item, [1, 7]) == [1, 7]) {
                    return true;
                }
            }
        }

        return false;
    }

    // 缺一门
    private function _isQueYiMen()
    {
        $typeArr = [];
        foreach (self::$_handCardsCountMap as $card => $cardCount) {
            $cardType = $this->getCardType($card);
            if ($cardType < 4 && !in_array($cardType, $typeArr)) {
                $typeArr[] = $cardType;
            }
        }
        if (count($typeArr) == 2) {
            return true;
        }
        return false;
    }

    // 幺九刻
    private function _isYaoJiuKe()
    {
        $result = self::$_splitArr;
        foreach ($result as $item) {
            if (count($item) >= 3 && $item[0] == $item[2]) {
                if (!in_array($item[0], [45, 46, 47])) {
                    if (in_array($item[0], [11, 19, 21, 29, 31, 39, 41, 42, 43, 44])) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    // 无字
    private function _isWuZi()
    {
        if (!array_intersect(array_keys(self::$_handCardsCountMap), [41, 42, 43, 44, 45, 46, 47])) {
            return true;
        }
        return false;
    }

    // 明杠
    private function _isMingGang()
    {
        return self::$_params['ming_gang_count'] > 0 ? true : false;
    }

    // 边张(只有123的3，或 789的7 才是边张)
    private function _isBianZhang()
    {
        $list = [];
        $result = $this->_splitCard(false);
        if (!empty($result)) foreach ($result as $item) {
            if (count($item) == 3 && $item[0] + 2 == $item[2] && in_array(self::$_params['hu_card'], $item)) {
                $list[] = $item;
            }
        }
        if (empty($list)) {
            return false;
        }
        if (count($list) == 1 && in_array($list[0][0] % 10, [1, 7])) {
            if ($list[0][0] % 10 == 1 && self::$_params['hu_card'] % 10 == 3) {
                return true;
            } elseif ($list[0][0] % 10 == 7 && self::$_params['hu_card'] % 10 == 7) {
                return true;
            }
        }
        return false;
    }

    // 嵌张  3,4,4,5,5,6
    private function _isKanZhang()
    {
        $list = [];
        foreach (self::$_splitArr as $item) {
            if (count($item) == 3 && $item[0] + 2 == $item[2] && in_array(self::$_params['hu_card'], $item)) {
                $list[] = $item;
            }
        }
        if (empty($list)) {
            return false;
        }
        if (count($list) == 1) {
            $idx = array_search(self::$_params['hu_card'], $list[0]);
            if ($idx == 1) {
                return true;
            }
        } else {
            foreach ($list as $item) {
                $idx = array_search(self::$_params['hu_card'], $item);
                if ($idx == 0 || $idx == 2) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    // 单钓
    private function _isDanDiao()
    {
        $list = [];
        foreach (self::$_splitArr as $item) {
            if (count($item) == 2 && $item[0] == $item[1] && in_array(self::$_params['hu_card'], $item)) {
                $list[] = $item;
            }
        }
        if (empty($list)) {
            return false;
        }
        if (count($list) == 1) {
            return true;
        }
        return false;
    }

    // 自摸
    private function _isZiMo()
    {
        return self::$_params['is_zi_mo'] == 1 ? true : false;
    }

    /** =================1番end=========================== **/


    /**
     * 理牌.
     *
     * @param $cards
     * @return bool
     */
    private function _sortCard(& $cards, & $result)
    {

        $len = count($cards);
        if ($len == 0) {
            return true;
        } elseif ($len < 3) {
            return false;
        }

        if (isset($cards[2]) && $cards[0] == $cards[2]) {
            $result[] = [$cards[0], $cards[1], $cards[2]];
            array_splice($cards, 0, 3);
            return $this->_sortCard($cards, $result);
        } else {
            if (in_array($cards[0] + 1, $cards) && in_array($cards[0] + 2, $cards)) {
                $result[] = [$cards[0], $cards[0] + 1, $cards[0] + 2];
                $key = $cards[0];
                array_splice($cards, 0, 1);
                array_splice($cards, array_search($key + 1, $cards), 1);
                array_splice($cards, array_search($key + 2, $cards), 1);
                return $this->_sortCard($cards, $result);
            }
        }
    }

    /**
     * 拆牌.
     *
     * @return array
     */
    private function _splitCard($isMergeKnownCard = true)
    {
        $fbHandCards = self::$_handCards;
        $len = count($fbHandCards);
        for ($i = 0; $i < $len - 1; $i++) {
            if ($fbHandCards[$i] == $fbHandCards[$i + 1] && !isset($jCardList[$fbHandCards[$i]])) {
                $jCardList[$fbHandCards[$i]] = [$fbHandCards[$i], $fbHandCards[$i]];
                $i++;
            }
        }
        if (!empty($jCardList)) {
            while ($jCard = array_shift($jCardList)) {
                $fbHandCard = $fbHandCards;
                $idx = array_search($jCard[0], $fbHandCard);
                array_splice($fbHandCard, $idx, 2);
                $isHu = $this->analyseCards($fbHandCard);
                if ($isHu) {
                    $jCard = $jCard[0];
                    break;
                }
            }
            array_splice($fbHandCards, array_search($jCard, $fbHandCards), 2);
        }

        $fbHandCardsCountMap = array_count_values($fbHandCards);
        $uniqueArr = array_values(array_unique($fbHandCards));

        $firstCard = '';
        $isSiShun = true;
        $len = count(array_unique($fbHandCards));
        for ($i = 0; $i < $len; $i++) {
            if ($fbHandCardsCountMap[$uniqueArr[$i]] < 4) {
                $isSiShun = false;
                break;
            }
            if ($i == 0) {
                $firstCard = $uniqueArr[$i];
                continue;
            }
            if ($uniqueArr[$i] - $i != $firstCard) {
                $isSiShun = false;
                break;
            }
        }
        $result = [];
        if ($isSiShun === true) {
            $result = [
                $uniqueArr,
                $uniqueArr,
                $uniqueArr,
                $uniqueArr
            ];
        } else {
            $this->_sortCard($fbHandCards, $result);
        }

        if ($isMergeKnownCard) {
            if (!empty(self::$_knownCards)) foreach (self::$_knownCards as $item) {
                $result[] = $item;
            }
            sort($result);
        }
        if (!empty($jCard)) {
            $result[] = [$jCard, $jCard];
        }
        return $result;
    }
}