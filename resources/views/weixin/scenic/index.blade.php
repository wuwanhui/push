@extends('layouts.weixin')

@section('content')
    <div class="weui-toptips weui-toptips_warn js_tooltips">错误提示</div>

    <div class="container" id="container"></div>


    <script type="text/html" id="tpl_home">
        <div class="page">
            <div class="weui-search-bar" id="searchBar">
                <form class="weui-search-bar__form">
                    <div class="weui-search-bar__box">
                        <i class="weui-icon-search"></i>
                        <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
                        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                    </div>
                    <label class="weui-search-bar__label" id="searchText">
                        <i class="weui-icon-search"></i>
                        <span>搜索</span>
                    </label>
                </form>
                <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
            </div>

            <div class="page__bd">
                @foreach($lists as $item)
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__bd">
                            <img src="{{$item->titlePic}}" style="width: 100%"/>
                        </div>
                    </div>
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__hd"><h4
                                    class="weui-media-box__title">{{$item->name}}</h4>{{$item->grade}}星
                        </div>
                        <div class="weui-panel__bd">

                            <div class="weui-media-box weui-media-box_text">

                                <p class="weui-media-box__desc">
                                    @if(isset($item->attention))
                                        {{$item->attention}}
                                    @endif
                                    @if(isset($item->recommend))
                                        {{$item->recommend}}
                                    @endif
                                </p>

                            </div>
                            <div class="weui-media-box weui-media-box_small-appmsg">
                                <div class="weui-cells">
                                    @if(isset($item->produits))
                                        @foreach($item->produits as $proItem)
                                            <a class="weui-cell weui-cell_access"
                                               href="{{url('/weixin/order/create?pid='.$proItem->id.'&did=1')}}">
                                                <div class="weui-cell__bd weui-cell_primary">
                                                    <p>{{$proItem->name}}</p>
                                                </div>
                                                <span class="weui-cell__ft">{{$proItem->fixedPrice}}元</span>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>
            <div class="page__ft">
                {!! $lists->links() !!}
            </div>
        </div></script>
    <script type="text/javascript">
        $(function () {
            var $searchBar = $('#searchBar'),
                    $searchResult = $('#searchResult'),
                    $searchText = $('#searchText'),
                    $searchInput = $('#searchInput'),
                    $searchClear = $('#searchClear'),
                    $searchCancel = $('#searchCancel');

            function hideSearchResult() {
                $searchResult.hide();
                $searchInput.val('');
            }

            function cancelSearch() {
                hideSearchResult();
                $searchBar.removeClass('weui-search-bar_focusing');
                $searchText.show();
            }

            $searchText.on('click', function () {
                $searchBar.addClass('weui-search-bar_focusing');
                $searchInput.focus();
            });
            $searchInput
                    .on('blur', function () {
                        if (!this.value.length) cancelSearch();
                    })
                    .on('input', function () {
                        if (this.value.length) {
                            $searchResult.show();
                        } else {
                            $searchResult.hide();
                        }
                    })
            ;
            $searchClear.on('click', function () {
                hideSearchResult();
                $searchInput.focus();
            });
            $searchCancel.on('click', function () {
                cancelSearch();
                $searchInput.blur();
            });
        });

        $(function () {
            var winH = $(window).height();
            var categorySpace = 10;

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

@endsection
