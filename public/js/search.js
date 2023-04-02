$(document).ready(function () {

    $('#search-input').on('keyup', function () {
        var query = $(this).val();

        if (query.trim() === '') {
            $('#search-results').html('');
        } else {

            $.ajax({
                url: '/products/search',
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    var results = '';

                    $.each(data, function (index, product) {
                        results += '<div class="product">' +
                            '<button type="" class="btn btn-light" name="' + product.id + '" id="' + product.id + '" onclick="search_submit(this.name)">'
                             + product.name + '</button>' +
                            '</div>';
                    });

                    $('#search-results').html(results);
                }
            });
        }
    });


    $('#search-submit').click(function () {

        var query = $('#search-input').val();
        
        console.log(query);

        $.ajax({
            url: '/products/search_submit',
            type: 'GET',
            data: { query: query }
        });
    });


});
