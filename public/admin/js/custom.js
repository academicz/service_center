axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
$(document).ready(function () {
    $('#familySearchKeyWord').keyup(function () {
        let key = $(this).val();
        axios.get('families', {
            params: {
                key: key.trim(),
            }
        })
            .then(function (response) {
                $('#searchResult').html(response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    });
    const search = () => {
        let key = $('#memberSearchKeyWord').val();
        let gender = $('#gender').val();
        let age = $('#searchAge').val();
        let option = $('#memberOptions').val();
        axios.get('search', {
            params: {
                key: key.trim(),
                gender: gender,
                age: age,
                option: option,
            }
        })
            .then(function (response) {
                $('#memberSearchResult').html(response.data);
            });
    };

    const get = ({params, url}) => {
        return new Promise((resolve, reject) => {
            axios.get(url, {
                params: params
            }).then(function (response) {
                resolve(response)
            }).catch(response => {
                reject(response);
            });
        });
    };

    const loadMember = (load) => {
        let family = $('#familyList').val();
        let bride = $('#bride').val();
        get({
            params: {
                family: family,
                bride: bride,
                gender: 'male',
            }, url: 'get-family-member-list'
        }).then(response => {
            $('#groom').html(response.data);
        }).catch(response => {
            throw 'Network Error';
        });

        get({
            params: {
                family: family,
                bride: bride,
                gender: 'female',
            }, url: 'get-family-member-list'
        }).then(response => {
            if (load === 1)
                $('#bride').html(response.data);
        }).catch(response => {
            throw 'Network Error';
        });
    };
    $('#memberSearchKeyWord').keyup(function () {
        search();
    });
    $('#gender').change(function () {
        search();
    });
    $('#memberOptions').change(function () {
        search();
    });
    $('#searchAge').keyup(function () {
        search();
    });
    $('#familyList').change(function () {
        loadMember(1);
    });
    $('#bride').change(function () {
        loadMember(2);
    });
    $('#cFamilyList').change(function () {
        let family = $(this).val();
        get({
            params: {
                family: family,
            }, url: 'get-family-member-list'
        }).then(response => {
            $('#members').html(response.data);
        }).catch(response => {
            throw 'Network Error';
        });
    });

    $(document).on('click', '#rowClick', function () {
        window.location = $(this).data('url');
    });

    if (window.location.pathname === '/committee') {
        let family = $('#cFamilyList').val();
        get({
            params: {
                family: family,
            }, url: 'get-family-member-list'
        }).then(response => {
            alert('dfs');
            $('#members').html(response.data);
        }).catch(response => {
            throw 'Network Error';
        });
    }

    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let message = $(this).data('message');
        let url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: message,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                window.location = url;
            }
        });
    });
});
