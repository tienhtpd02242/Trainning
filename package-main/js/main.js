;( function( w, $ ) {
    'use strict';

    $(document).ready( function() {

        filterPostByCategory();
        filterPostByPostTypeAndPagination();

        $(document).on( 'click', '.wrap_pagination a.page-numbers' , function(e) {
            e.preventDefault();

            var href = $(this).attr('href');

            let number_page = gup('paged', href);
            console.log(number_page);
            
            
            let button = $(this),
            data = {
                'action' : 'pagination_load',
                'page' : number_page,
            };

            $.ajax({
                url: pj_php_data.ajaxurl,
                data: data,
                type: 'POST',

                success: function( response ){
                    $('.wrap__post .wrap').html( response.contents );
                    
                    $('.wrap_pagination').html( response.pagination );

                    // console.log(response.pagination);
                }
            });
            
        });
        
        $('#loadMoreTemplate').click( function(e) {
            e.preventDefault();
            
            let currentPageLoadMore = parseInt( $('#currentPage').val() );
            let nextPageLoadMore = currentPageLoadMore + 1;
            $('#currentPage').val(nextPageLoadMore);

            let maxPageLoadMore = $('#max_page').val();

            let button = $(this),
                data = {
                    'action' : 'tranning_load_more',
                    'next_page' : nextPageLoadMore,
                };

            $.ajax({
                url: pj_php_data.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function( xhr ){
                    button.text('Loading...');
                },
                success: function( data ){
                    button.text('Load More');
                    if( nextPageLoadMore == maxPageLoadMore ){
                        button.remove();
                    }
                    if( data ){
                        $('.wrap-body.loadmore .wrap-cat').append(data);
                    }
                }
            });

        });

        var searchRequest = null;
        let minlength = 1;
        $("#valueInputSearch").keyup(function () {
            var that = this,
            value = $(this).val();

            if (searchRequest != null){
                searchRequest.abort();
            }

            searchRequest = $.ajax({
                type: "POST",
                url: pj_php_data.ajaxurl,
                data: {
                    action: 'data_fetch_search_ajax', 
                    keyword: value ? value : ' ', 
                },
                beforeSend: function(){

                },
                success: function(data){
                    if (data) {
                        $('.wrap__post .wrap').html( data );
                    }
                }
            }); 
        });

        $('#valueInputSearch').blur(function () {
            let keyValue = $(this).val();
            if( !keyValue ){
                $('.wrap_search').html('');
                $('.loader-text').css('display','none');
            }
        });

    });


    function filterPostByCategory(){
        $('.list-cat ul li').click( function() {
            $('.list-cat ul li').removeClass('active');
            $(this).addClass('active');

            let dataCategorySlug = $(this).data('cat');

            let valueArrCat = $('#arrayCategory').val();

            _ajaxFilterCategory(1, dataCategorySlug, valueArrCat);

        });

        $(document).on( 'click', '.wrap_pagination_cat a.page-numbers', function(e) {
            e.preventDefault();

            var hrefPage = $(this).attr('href');
            let number_page = gup('paged', hrefPage);
            
            let ul = $(this).parents('.__post-filter').siblings('#ulFilterCat');
            let catSlug = ul.find('li.active').data('cat');
            
            _ajaxFilterCategory(number_page, catSlug);

        });
    }
    function _ajaxFilterCategory( page = 1, dataCategorySlug , valueArrCat){
        $.ajax({
            url: pj_php_data.ajaxurl,
            data: {
                'action' : 'filter_post_by_category',
                'slug_cat' : dataCategorySlug,
                'data_arr' : valueArrCat,
                'next_page' : page,
            },
            type: 'POST',

            success: function( response ){
                console.log(response.status);
                
                $('.__post-filter .wrap-cat').html(response.item_posts);
                $('.wrap_pagination_cat').html( response.pagination_filter );
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    }

    function filterPostByPostTypeAndPagination(){
        $('header.filterPT ul li a').click( function(e) {
            e.preventDefault();

            $('header.filterPT ul li a').removeClass('active');
            $(this).addClass('active');

            var href = $(this).attr('href');
            var slug_pt = href.replace('?', '');

            ajaxFilterPostType(1, slug_pt);
        });

        $(document).on('click', '.wrap_pagination_pt a.page-numbers', function(e) {
            e.preventDefault();

            let href_pagination = $(this).attr('href');
            let num_page = gup('paged', href_pagination);
            
            let attrHref = $('header.filterPT ul li a.active').attr('href') ? $('header.filterPT ul li a.active').attr('href') : 'all';
            let location = attrHref.replace('?', '');

            ajaxFilterPostType(num_page, location);
        });
    }
    function ajaxFilterPostType(paged = 1, $post_type){
        $.ajax({
            url: pj_php_data.ajaxurl,
            data: {
                'action' : 'filterPostByPostType',
                'paged'     : paged,
                'post_type' : $post_type,
            },
            type: 'POST',

            success: function( data ){
                console.table(data.status);
                
                $('.wrap-cat.posttype').html( data.items );
                $('.wrap_pagination_pt').html( data.paginations );
            }
        });
    }

    function gup( name, url ) {
        if (!url) url = location.href;
        name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regexS = "[\\?&]"+name+"=([^&#]*)";
        var regex = new RegExp( regexS );
        var results = regex.exec( url );
        return results == null ? 0 : results[1];
    }

} )( window, jQuery );
