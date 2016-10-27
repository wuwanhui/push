<?php

/**
 * TOP API: alibaba.aliqin.fc.sms.num.send request
 *
 * @author auto create
 * @since 1.0, 2016.05.24
 */
class AddOrderRequest
{
    /**
     * 内部使用标志
     **/
    private $bl;

    /**
     * 订单类型，1为普通订单（分销商已经收款），2为预订订单（分销商未收款）。
     **/
    private $type;

    /**
     * 订单编号 分销商校验码 利用分销商编码和订单编号进行唯一校验
     **/
    private $orderid;

    /**
     * 订单实际成交价格
     **/
    private $realprice;

    /**
     * 联系人
     **/
    private $contactname;

    /**
     * 联系电话
     **/
    private $contactphone;


    /**
     * 身份证号码
     **/
    private $idcardcode;

    /**
     * 到达日期
     **/
    private $arrivedate;

    /**
     * 联系人行政区划
     **/
    private $contactarea;

    /**
     * 产品列表
     **/
    private $productLists;

    /**
     * 产品
     **/
    private $product;

    /**
     * 产品编码
     **/
    private $procode;
    /**
     * 订购数量
     **/
    private $buynum;
    /**
     * 订购单价
     **/
    private $buyprice;
    /**
     * 订购总价
     **/
    private $buytotaoprice;
    /**
     * 扩展属性
     **/
    private $extend;

    /**
     * 扩展属性
     **/
    private $content;


    /**
     * @return mixed
     */
    public function getBl()
    {
        return $this->bl;
    }

    /**
     * @param mixed $bl
     */
    public function setBl($bl)
    {
        $this->bl = $bl;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @param mixed $orderid
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
    }

    /**
     * @return mixed
     */
    public function getRealprice()
    {
        return $this->realprice;
    }

    /**
     * @param mixed $realprice
     */
    public function setRealprice($realprice)
    {
        $this->realprice = $realprice;
    }

    /**
     * @return mixed
     */
    public function getContactname()
    {
        return $this->contactname;
    }

    /**
     * @param mixed $contactname
     */
    public function setContactname($contactname)
    {
        $this->contactname = $contactname;
    }

    /**
     * @return mixed
     */
    public function getContactphone()
    {
        return $this->contactphone;
    }

    /**
     * @param mixed $contactphone
     */
    public function setContactphone($contactphone)
    {
        $this->contactphone = $contactphone;
    }

    /**
     * @return mixed
     */
    public function getIdcardcode()
    {
        return $this->idcardcode;
    }

    /**
     * @param mixed $idcardcode
     */
    public function setIdcardcode($idcardcode)
    {
        $this->idcardcode = $idcardcode;
    }

    /**
     * @return mixed
     */
    public function getArrivedate()
    {
        return $this->arrivedate;
    }

    /**
     * @param mixed $arrivedate
     */
    public function setArrivedate($arrivedate)
    {
        $this->arrivedate = $arrivedate;
    }

    /**
     * @return mixed
     */
    public function getContactarea()
    {
        return $this->contactarea;
    }

    /**
     * @param mixed $contactarea
     */
    public function setContactarea($contactarea)
    {
        $this->contactarea = $contactarea;
    }

    /**
     * @return mixed
     */
    public function getProductLists()
    {
        return $this->productLists;
    }

    /**
     * @param mixed $productLists
     */
    public function setProductLists($productLists)
    {
        $this->productLists = $productLists;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProcode()
    {
        return $this->procode;
    }

    /**
     * @param mixed $procode
     */
    public function setProcode($procode)
    {
        $this->procode = $procode;
    }

    /**
     * @return mixed
     */
    public function getBuynum()
    {
        return $this->buynum;
    }

    /**
     * @param mixed $buynum
     */
    public function setBuynum($buynum)
    {
        $this->buynum = $buynum;
    }

    /**
     * @return mixed
     */
    public function getBuyprice()
    {
        return $this->buyprice;
    }

    /**
     * @param mixed $buyprice
     */
    public function setBuyprice($buyprice)
    {
        $this->buyprice = $buyprice;
    }

    /**
     * @return mixed
     */
    public function getBuytotaoprice()
    {
        return $this->buytotaoprice;
    }

    /**
     * @param mixed $buytotaoprice
     */
    public function setBuytotaoprice($buytotaoprice)
    {
        $this->buytotaoprice = $buytotaoprice;
    }

    /**
     * @return mixed
     */
    public function getExtend()
    {
        return $this->extend;
    }

    /**
     * @param mixed $extend
     */
    public function setExtend($extend)
    {
        $this->extend = $extend;
    }


    /**
     * @param mixed $extend
     */
    public function getContent()
    {
        $_doc = new DOMDocument('1.0', 'utf-8');
        // 排版格式

        $_doc->formatOutput = true;

        // 创建一个主标签
        $_root = $_doc->createElement('root');

        // 创建bl
        $_bl = $_doc->createElement('bl');
        // 给 version 标签里赋值
        $_blTextNode = $_doc->createTextNode($this->bl);
        // 将值放入 version 标签里
        $_bl->appendChild($_blTextNode);
        // 将一级标签 version 放入 root 里
        $_root->appendChild($_bl);

        // 将主标签写入 xml
        $_doc->appendChild($_root);
        // 生成 xml
        print_r($_doc->saveXML());

    }


}
