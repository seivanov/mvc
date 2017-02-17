$().ready(function(){

    var gallery = [];

    function loadFileFromInput(input,typeData) {
        var reader,
            fileLoadedEvent,
            files = input.files;

        if (files && files[0]) {
            reader = new FileReader();

            reader.onload = function (e) {
                fileLoadedEvent = new CustomEvent('fileLoaded',{
                    detail:{
                        data:reader.result,
                        file:files[0]
                    },
                    bubbles:true,
                    cancelable:true
                });
                input.dispatchEvent(fileLoadedEvent);
            };

            switch(typeData) {
                case 'arraybuffer':
                    reader.readAsArrayBuffer(files[0]);
                    break;
                case 'dataurl':
                    reader.readAsDataURL(files[0]);
                    break;
                case 'binarystring':
                    reader.readAsBinaryString(files[0]);
                    break;
                case 'text':
                    reader.readAsText(files[0]);
                    break;
            }
        }
    }

    function createImg(data) {
        $('.img_preview').append('<div class="img_wrapper"><img src="'+data+'"></div>');
    }

    function fileHandler (e) {
        var data = e.detail.data,
            fileInfo = e.detail.file;

        var container = {};
        container.name = fileInfo.name;
        container.data = data;

        gallery.push(container);

        createImg(data);
    }

    var input = document.getElementById('inputId');

    input.onchange = function (e) {
        loadFileFromInput(e.target,'dataurl');
    };

    input.addEventListener('fileLoaded',fileHandler);

    $('#add').click(function(){

        fdata = $('#fadd').serialize();

        $.ajax({
            method: "POST",
            url: "/ajax/addtask",
            data: { form: fdata, gallery:gallery }
        })
        .done(function( msg ) {
            window.location.href = '/';
        });

    });

});