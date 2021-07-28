$(document).ready(function () {

    var checkId = $('#checkId').val();
    var uri = $('#uri').val();
    var url = $('#url').val();

    $("#search").keyup(function () {
        let searchText = $(this).val();
        if (searchText != "") {
            $.ajax({
                url: url,
                method: "post",
                data: {
                    query: searchText,
                    checkId: checkId,
                    uri: uri,
                },
                success: function (response) {
                    $("#show-list").html(response);
                },
            });
        } else {
            $("#show-list").html("");
        }
    });
    // Set searched text in input field on click of search button
    $(document).on("click", "a", function () {
        $("#search").val($(this).text());
        $("#show-list").html("");
    });
});