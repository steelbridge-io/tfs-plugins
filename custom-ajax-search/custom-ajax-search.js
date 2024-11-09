jQuery(document).ready(function($) {
    $('#custom-search-field').on('keyup', function() {
        var search_term = $(this).val();

        // Only trigger the ajax if the search term is at least 3 characters long
        if (search_term.length >= 3) {
            $.ajax({
                url: cas_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'custom_ajax_search',
                    search_term: search_term
                },
                success: function(response) {
                    var $results = $('#custom-search-results');
                    $results.empty();

                    if (response.length) {
                        $.each(response, function(index, value) {
                            $results.append('<div class="custom-search-result-item"><a href="' + value.link + '">' + value.title + '</a></div>');
                        });
                    } else {
                        $results.append('<div class="custom-search-result-item">No results found</div>');
                    }
                }
            });
        } else {
            $('#custom-search-results').empty(); // Clear results if less than 3 characters
        }
    });
});