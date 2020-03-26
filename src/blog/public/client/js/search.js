jQuery(document).ready(function($) {
    var engine = new Bloodhound({
        remote: {
            url: '/find?value=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $('.search-input').typeahead({
        hint: true,
        highlight: true,
        minLength: 3,
        href: null,
    }, {
        name: 'engine',
        displayKey: 'value',
        source: engine.ttAdapter(),
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
            ],
            header: [
                '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function (data) {
                return '<a href="http://127.0.0.1:8000/book/'+data.slug+'" class="list-group-item">' + data.title + '--' + data.author + '</a>'
            }
        }
    });
});
