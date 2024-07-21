$(document).ready(function () {
    $("#images").change(function () {
        var fileArr = [];
        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];

        $('#image_preview').html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;

        $('#old_image').remove();

        for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 1048576) {
                return false;
            } else {
                fileArr.push(total_file[i]);
                $('#image_preview').append("<div class='img-div' id='img-div" + i + "'>" +
                    "<" +
                    "img src='" + URL.createObjectURL(event.target.files[i]) + "' class='image img-thumbnail' title='" + total_file[i].name + "'>" +
                    "<div class='middle'>" +
                    "<button id='action-icon' value='img-div" + i + "' class='btn btn-danger' role='" + total_file[i].name + "'>" +
                    "<i class='fa fa-trash'></i>" +
                    "</button></div></div>");
            }
        }
    });

    $("#images_all").change(function () {
        var fileArr = [];

        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];

        $('#image_previews').html("");
        var total_file = document.getElementById("images_all").files;
        if (!total_file.length) return;

        $('#old_image').remove();

        for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 1048576) {
                return false;
            } else {
                fileArr.push(total_file[i]);
                $('#image_previews').append("<div class='img-div' id='img-div" + i + "'>" +
                    "<" +
                    "img src='" + URL.createObjectURL(event.target.files[i]) + "' class='image img-thumbnail' title='" + total_file[i].name + "'>" +
                    "<div class='middle'>" +
                    "<button id='action-icon' value='img-div" + i + "' class='btn btn-danger' role='" + total_file[i].name + "'>" +
                    "<i class='fa fa-trash'></i>" +
                    "</button></div></div>");
            }
        }
    });

    $(document).on('click', '#remove_image', function () {
        // Xoá ảnh khỏi DOM
        $(this).prev('img').remove();
        $(this).remove();
    });

    $('body').on('click', '#action-icon', function (evt) {
        var divName = this.value;
        var fileName = $(this).attr('role');
        $(`#${divName}`).remove();

        for (var i = 0; i < fileArr.length; i++) {
            if (fileArr[i].name === fileName) {
                fileArr.splice(i, 1);
            }
        }
        document.getElementById('images').files = FileListItem(fileArr);
        evt.preventDefault();
    });

    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments)
        for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
        if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
        for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
        return b.files
    }
});


