(function($) {
    $(".gtp-select").select2({
        tokenizer: function(input, selection, callback) {
            if (input.indexOf(',') < 0)
                return;
            
            var parts = input.split(",");
            for (var i = 0; i < parts.length; i++ ) {
                var valid = true;
                var part = parts[i];
                part = part.trim().toLowerCase();

                for (var j = 0; j < selection.length; j++) {
                    if (selection[j].id == part) {
                        valid = false;
                    }
                }

                if (valid && available_countries[part]) {
                    callback({id:part, text:available_countries[part]});
                }
            }
        }
    });

    $("#gtp-post-list-column, #gtp-post-list-column-posttypes, #gtp-active-on, #gtp-active-for, #gtp-active-for-specific").select2({ minimumResultsForSearch: -1 });

    $("#gtp-countries").on('change',function(e) {
        if (e.added !== undefined) {
            $("#gtp-country-all").remove();
            $("#gtp-country-display").append('<span id="gtp-country-' + e.added.id +'">' + e.added.text +'</span>');
        }
        if (e.removed !== undefined) {
            $("#gtp-country-" + e.removed.id).remove();
            if ($("#gtp-country-display > span").length === 0) {
                $("#gtp-country-display").append('<span id="gtp-country-all">All</span>');
            }
        }
    });

    $("#save-countries-list").click(function(e) {
        $("#gtp-country-select").slideToggle();
        $("#gtp-edit").show();
    });

    $("#clear-countries-list").click(function(e) {
        $('#gtp-countries').select2('val', '', true);
        $('#gtp-country-display [id^="gtp-country-"]').remove();
        $('#gtp-country-display').append('<span id="gtp-country-all">All</span>');
    });

    $("#gtp-edit").click(function(e) {
        $(this).hide();
        $("#gtp-country-select").slideToggle();
    });

    var gtp_frontpage_posts = $('input[name="gtp_frontpage_posts"]');
    if (gtp_frontpage_posts.length && gtp_frontpage_posts.val().trim() != 'none') {
        $('#gtp-countries-simulation').attr('disabled', 'disabled');
    }

    $('input[name="gtp_frontpage_posts"]').on('change', function(e) {
        if($(this).val() == 'none') {
            $('#gtp-countries-simulation').removeAttr('disabled');
        } else {
            $('#gtp-countries-simulation').attr('disabled', 'disabled');
        }
    });

    $('#gtp-post-list-column').change(function(e) {
        var $that = $(this);
        $('.gtp-post-list-column-note').addClass('hidden');
        $('#gtp-post-list-column-' + $that.val() + '-note').removeClass('hidden');

        if($that.val() == 'show_sel' || $that.val() == 'hide_sel') {
            $('#gtp-post-list-column-posttypes-tr').removeClass('hidden');
        } else {
            $('#gtp-post-list-column-posttypes-tr').addClass('hidden');
        }
    });

    var gtp_post_list_column = $('#gtp-post-list-column').val();
    $('#gtp-post-list-column-' + gtp_post_list_column + '-note').removeClass('hidden');

    if(gtp_post_list_column == 'show_sel' || gtp_post_list_column == 'hide_sel') {
        $('#gtp-post-list-column-posttypes-tr').removeClass('hidden');
    }

    $('#gtp-post-list').change(function(e) {
        var $that = $(this);
        $('.gtp-post-list-note').addClass('hidden');
        $('#gtp-post-list-' + $that.val() + '-note').removeClass('hidden');

        if($that.val() == 'show_sel' || $that.val() == 'hide_sel') {
            $('.gtp-post-list-posttypes-cont').removeClass('hidden');
        } else {
            $('.gtp-post-list-posttypes-cont').addClass('hidden');
        }
    });

    var gtp_post_list = $('#gtp-post-list').val();
    $('#gtp-post-list-' + gtp_post_list + '-note').removeClass('hidden');

    if(gtp_post_list == 'show_sel' || gtp_post_list == 'hide_sel') {
        $('.gtp-post-list-posttypes-cont').removeClass('hidden');
    }
})(jQuery);