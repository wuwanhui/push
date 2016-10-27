@extends('layouts.weixin')

@section('content')
    <div class="weui-toptips weui-toptips_warn js_tooltips">错误提示</div>

    <div class="container" id="container"></div>


    <script type="text/html" id="tpl_home">
        <form role="form" method="POST">
            <div class="page input js_show">
                <div class="page__bd">
                    <div class=" preview js_show">
                        <div class="page__bd">
                            <div class="weui-form-preview">
                                <div class="weui-form-preview__hd">
                                    <div class="weui-form-preview__item">
                                        <label class="weui-form-preview__label">付款金额</label>
                                        <em class="weui-form-preview__value"><label
                                                    id="total">{{$produits->fixedPrice}}</label>元</em>
                                    </div>
                                </div>
                                <div class="weui-form-preview__bd">
                                    <div class="weui-form-preview__item">
                                        <label class="weui-form-preview__label">景区</label>
                                        <span class="weui-form-preview__value">{{$scenic->name}}</span>
                                    </div>
                                    <div class="weui-form-preview__item">
                                        <label class="weui-form-preview__label">票型</label>
                                        <span class="weui-form-preview__value">{{$produits->name}}</span>
                                    </div>
                                    <div class="weui-form-preview__item">
                                        <label class="weui-form-preview__label">单价</label>
                                        <span class="weui-form-preview__value"><label
                                                    id="fixedPrice">{{$produits->fixedPrice}}</label>元</span>
                                    </div>
                                    @if($produits->attention)
                                        <div class="weui-form-preview__item">
                                            <label class="weui-form-preview__label">注意事项</label>
                                            <span class="weui-form-preview__value">{{$produits->attention}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="weui-cells__title">产品选择</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <a class="weui-btn weui-btn_mini weui-btn_warn" href="javascript:setData('2016-10-19')">明天</a>
                                <a class="weui-btn weui-btn_mini weui-btn_primary"
                                   href="javascript:setData('2016-10-19')">10-19</a>
                                <a class="weui-btn weui-btn_mini weui-btn_primary"
                                   href="javascript:setData('2016-10-20')">10-20</a>
                                <a class="weui-btn weui-btn_mini weui-btn_primary"
                                   href="javascript:setData('2016-10-21')">10-21</a>
                                <a class="weui-btn weui-btn_mini weui-btn_primary" href="javascript:">更多</a>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label for="" class="weui-label">日期</label></div>
                            <div class="weui-cell__bd text-right">
                                <input class="weui-input" type="date" value="2016-12-20" id="ydDate"    style="text-align: center">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">数量</label></div>
                            <div class="weui-cell__bd" style="text-align: right">
                                <div class="weui_cell_ft text-right">
                                    <a class="weui-btn weui-btn_mini weui-btn_default" id="reduce"
                                       href="javascript:js(false)"
                                       style="width: 30px;display: inline-block; text-align: center">-</a>
                                    <input class="weui-input" id="quantity" type="number" pattern="[0-9]*" value="1"
                                           style="width:30px;text-align: center;" disabled>
                                    <a class="weui-btn weui-btn_mini weui-btn_default" id="add" class="add"
                                       href="javascript:js(true)"
                                       style="width: 30px;display: inline-block; text-align: center">+</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="weui-cells__title">预定信息</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="请输入联系人">
                            </div>
                        </div>
                        <div class="weui-cell weui-cells_form">
                            <div class="weui-cell__hd"><label class="weui-label">手机</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="tel" placeholder="用于接收消费码">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">身份证</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="请输入订票人身份证号">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">收件地址</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="收件地址">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">备注</label></div>
                            <div class="weui-cell__bd">
                                <textarea class="weui-textarea" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                    <label for="weuiAgree" class="weui-agree">
                        <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox" checked>
                         <span class="weui-agree__text">
                        阅读并同意<a href="javascript:void(0);">《相关条款》</a>
            </span>
                    </label>

                    <div class="weui-btn-area">
                        <a class="weui-btn weui-btn_primary" id="showToast">
                            预定
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function js(isAdd) {
                var total = $("#total");
                var quantity = $("#quantity");
                var fixedPrice = $("#fixedPrice");
                var quantityVal = quantity.val();
                if (isAdd) {
                    quantityVal++;
                } else {
                    quantityVal--;
                }

                var fixedPriceVal = fixedPrice.text();
                var totalVal = fixedPrice.text();
                if (quantityVal > 0) {
                    quantity.val(quantityVal);
                    total.text(quantityVal * fixedPriceVal);
                }
            }

            function setData(_date) {
                var ydDate = $("#ydDate");
                ydDate.val(_date);
            }
            $(function () {
                var winH = $(window).height();
                var $toast = $('#toast');
                $('#showToast').on('click', function () {
                    if ($toast.css('display') != 'none') return;

                    $toast.fadeIn(100);
                    setTimeout(function () {
                        $toast.fadeOut(100);
                    }, 2000);
                });
//                $('.add').on('click', function () {
//                    var quantity = $("#quantity");
//                    var val = quantity.text();
//                    val++;
//                    quantity.text(val);
//                });

                $('.js_item').on('click', function () {
                    var id = $(this).data('id');
                    window.pageManager.go(id);
                });
                $('.js_category').on('click', function () {
                    var $this = $(this),
                            $inner = $this.next('.js_categoryInner'),
                            $page = $this.parents('.page'),
                            $parent = $(this).parent('li');
                    var innerH = $inner.data('height');
                    bear = $page;

                    if (!innerH) {
                        $inner.css('height', 'auto');
                        innerH = $inner.height();
                        $inner.removeAttr('style');
                        $inner.data('height', innerH);
                    }

                    if ($parent.hasClass('js_show')) {
                        $parent.removeClass('js_show');
                    } else {
                        $parent.siblings().removeClass('js_show');

                        $parent.addClass('js_show');
                        if (this.offsetTop + this.offsetHeight + innerH > $page.scrollTop() + winH) {
                            var scrollTop = this.offsetTop + this.offsetHeight + innerH - winH + categorySpace;

                            if (scrollTop > this.offsetTop) {
                                scrollTop = this.offsetTop - categorySpace;
                            }

                            $page.scrollTop(scrollTop);
                        }
                    }
                });
            });
    </script>
    <!--BEGIN toast-->
    <div id="toast" style="display: none;">
        <div class="weui-mask_transparent"></div>
        <div class="weui-toast">
            <i class="weui-icon-success-no-circle weui-icon_toast"></i>
            <p class="weui-toast__content">已完成</p>
        </div>
    </div>
    <!--end toast-->

    </script>


@endsection
