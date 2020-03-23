(function () {

    const init = function () {
        _setUpListners();
        var text = $.cookie('sort') ? $.cookie('sort') : 'ASC';
        $('.header__order').html(text);
    };

    const _setUpListners = function () {
        $('.start__btn').on('click', function () {
            var link = $(this).attr('data-link');
            document.location.href = '/' + link;
        });
        $('.user__item').on('click', function () {
            var id = $(this).find('.user__id').text();
            document.location.href = '/file/user/' + parseInt(id);
        });
        $('.header__btn').on('click', function (e) {
            var action = $(e.target).attr('data-action');
            document.location.href = '/user/' + action;
        });
        $('.files__btn').on('click', function (e) {
            var id = $(e.target).attr('data-id');
            document.location.href = '/file/add/' + id;
        });
        $('.header__order').on('click', function () {
            if ($.cookie('sort') && $.cookie('sort') === 'DESC') {
                $.cookie('sort', 'ASC', {path: '/'});
            } else {
                $.cookie('sort', 'DESC', {path: '/'});
            }
            document.location.href = '/user';
        });
        $('.admin__edit').on('click', function () {
            var id = $(this).attr('data-id');
            document.location.href = '/admin/edit/' + id;
        });
        $('.admin__delete').on('click', function () {
            var id = $(this).attr('data-id');
            if (confirm('Delete userID: ' + id + '?')) {
                document.location.href = '/admin/delete/' + id;
            }
        });
        $('.admin__create').on('click', function () {
            document.location.href = '/admin/create';
        });
    };

    return init();
})();