/*------addClass/removeClass categories-------*/
var w = window.innerWidth;

if(w > 991) {
    /*categories slideToggle*/
    $(".categories_title").on("click", function() {
        $(this).toggleClass('active');
        $('.categories_menu_inner').stop().slideToggle('medium');
    });


    /*------addClass/removeClass categories-------*/
    $(".categories_menu_inner > ul > li").on("mouseover", function() {
        $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').addClass('open');
        $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
    });

    $(document).click(function(e)
    {
        var container = $(".categories_title");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.removeClass('active');
            $('.categories_menu_inner').stop().slideUp('medium');
        }
    });

//  $(document).on('mouseover', function(e)
//  {
//      var container = $(".categories_menu_inner, .categories_mega_menu, .categories_title");
//
//      // if the target of the click isn't the container nor a descendant of the container
//      if (!container.is(e.target) && container.has(e.target).length === 0)
//      {
//        $('.categories_menu_inner').stop().slideUp('medium');
//        $('.categories_mega_menu, .categorie_sub').removeClass('open');
//         $(".categories_mega_menu").removeClass('open');
//         $(".categories_title").removeClass('active');
//      }
//
//
//
//  });




}




/*------addClass/removeClass categories-------*/


if(w <= 991)
{
    $(".categories_title").on("click", function() {
        $(this).toggleClass('active');
        $('.categories_menu_inner').stop().slideToggle('medium');
    });

    /*------addClass/removeClass categories-------*/
    $(".categories_menu_inner > ul > li").on("click", function() {
        $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').toggleClass('open');
        $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
    });



    $(document).on('click', function(e)
    {
        var container = $(".categories_menu_inner, .categories_mega_menu, .categories_title");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            $('.categories_menu_inner').stop().slideUp('medium');
            $('.categories_mega_menu, .categorie_sub').removeClass('open');
            $(".categories_mega_menu").removeClass('open');
            $(".categories_title").removeClass('active');
        }
    });

    $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").on('click',function(){
        $(this).find('i').toggleClass('fa-plus').toggleClass('fa-minus');
    });

    $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").each(function(){
        $(this).html('<i class="fas fa-plus"></i>');
    });

}
$(document).ready(function(){
    $('.flash_deal_carousel').slick({
        rows:2,
        slidesPerRow: 7,
        infinite:true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesPerRow: 5,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesPerRow: 4,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesPerRow: 3,
                }
            },
            {
                breakpoint: 577,
                settings: {
                    slidesPerRow: 2,
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.category_carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 577,
                settings: {
                    slidesToShow: 2,
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.brand_carousel').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 577,
                settings: {
                    slidesToShow: 2,
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.buyer_carousel').slick({
        dots: false,
        vertical: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        verticalSwiping: true,
        autoplay:true,
        autoplaySpeed:1500,
    });
});