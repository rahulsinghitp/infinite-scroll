var pinkvilla_url = 'https://www.pinkvilla.com/';

$(document).ready(function(e) {

    var isLoadingData = false;
    $(window).on('resize scroll', function() {
        if ($('.bottom').isInViewport() && isLoadingData == false) {
            console.log('AAAAA');
            isLoadingData = true;
            var page_no = parseInt($('.bottom').attr('data-page')) + 1;
            console.log(page_no);
            $.ajax({
                url: 'pinkvilla-fashion-ajax.php?page=' + page_no,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $.each(response.nodes, function(key, data) {
                        var title = data.node.title;
                        var image_path = data.node.field_photo_image_section;
                        var nid = data.node.nid;
                        var path = data.node.path;
                        var html = '<div data-item="' + key + '" class="fashion-data fl-left mb-1" data-nid="' + nid + '"><div class="wrapper">';
                        html = html + '<div class="row mb-1"><div class="img-container "><a href="' + pinkvilla_url + path + '" target="_blank" rel="noreferrer"><img src="'  + pinkvilla_url + image_path + '" alt="' + title + '" title="' + title + '"/></a></div></div>';
                        html = html + '<div class="row title-container"><div class="title col-8 fl-left"><a href="' + pinkvilla_url + path + '" class="title-link" target="_blank" rel="noreferrer" title="' + title + '"><b>' + title + '</b></a></div><div class="col-2"></div></div>';
                        html = html + '</div></div>';
                        $('.container-data').append(html);
                        console.log(data);
                    });
                    $('.bottom').attr('data-page', page_no);
                    isLoadingData = false;
                }
            });
        }
    });

    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };
});
