(function () {

    const init = function () {
        _setUpListners();
    };

    const _setUpListners = function () {
        $('.user__item').on('click', function (e) {
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
            if (!$(this).data('status')) {
                $(this).html('DESC');
                $(this).data('status', true);
            }
            else {
                $(this).html('ASC');
                $(this).data('status', false);
            }
        });
    };

    return init();
})();