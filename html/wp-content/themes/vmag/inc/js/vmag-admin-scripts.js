jQuery(document).ready(function($) {
    
    // Page Metabox section
    $('.pg-metabox div').first().fadeIn();
    
    $('ul.vmag-page-meta-tabs li').click(function (){
        var id = $(this).attr('atr');
        
        $('ul.vmag-page-meta-tabs li').removeClass('active');
        $(this).addClass('active')
        
        $('.pg-metabox .pg-metabox-inside').hide();
        $('#'+id).fadeIn();
    });

    /**
     * Script for image selected from radio option
     */
     $('#vmag-img-container-meta li img').click(function(){
        $('#vmag-img-container-meta li').each(function(){
            $(this).find('img').removeClass ('vmag-radio-img-selected') ;
        });
        $(this).addClass ('vmag-radio-img-selected') ;
    });

});