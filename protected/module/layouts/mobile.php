<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/3/10
 * Time: 16:43
 */
?>

<?php echo \CC\util\common\widget\widget\WidgetBuilder::build(new \CC\util\common\widget\widget\LayoutsWidget(
        '微整形',
        $content,
        include "leftnav.php",
        'mobile',
        [
            'common_cssJs' => [
                '/public/biz/wx/common/css/wx.css',
                '/public/biz/wx/common/js/wx.js',

                '/public/biz/swiper/css/swiper.min.css',
            '/public/biz/swiper/js/swiper.min.js',
                '/public/biz/swipeSlide/js/swipeSlide.min.js',
                '/public/biz/wx/common/css/style.css?10',
                '/public/biz/wx/common/js/script.js?9',

            ]
        ]
)) ?>
