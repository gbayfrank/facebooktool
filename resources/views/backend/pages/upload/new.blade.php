@extends('backend.main')
@section('content')
<div class="right_col">
    <div>
        @include('backend.elements.page_title')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3>Tải lên</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div id="gbay-upload-ui" class="drag-drop">
                    <div id="drag-drop-area">
                        <div class="drag-drop-inside">
                            <p class="drag-drop-info">Kéo thả các tập tin để tải lên</p>
                            <p>hoặc</p>
                            <input type="file" id="files" name="files" multiple hidden>    
                            <label for="files" class="btn gbay-btn-upload btn-success">
                                <i class="fa fa-upload"></i>&nbsp;Tải lên
                            </label> 
                        </div>
                    </div>                  
                </div>                         
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12" style="margin-top:10px;">
                <progress id="progress-bar" max=100 value=0></progress>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="margin-top:10px;">
                    <div class="x_content" id="x_content">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    const dropArea = document.getElementById('gbay-upload-ui');
    const files = document.getElementById('files');
    let filesDone = 0;
    let filesToDo = 0;
    let progressBar = document.getElementById('progress-bar')

    function initializeProgress(numfiles) {
        progressBar.value = 0
        filesDone = 0
        filesToDo = numfiles
    }

    function progressDone(data) {
        filesDone++;
        progressBar.value = filesDone / filesToDo * 100;
        // console.log(data);
    }

    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
    }

    ;['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    })

    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    })

    function highlight(e) {
        dropArea.classList.add('highlight')
    }

    function unhighlight(e) {
        dropArea.classList.remove('highlight')
    }

    dropArea.addEventListener('drop', handleDrop, false)

    function handleDrop(e) {
        const files = e.dataTransfer.files
        handleFiles(files)
    }

    delete_img = (obj, id) => {
        const c = confirm("Bạn chắc chắn muốn xóa");
        if(c == true) {
            postUploadData('/admin/uploads/ajax-delete', {id : id})
            .then(function(data) {
                alert(data.success);
                obj.parentElement.parentElement.remove();
            })
            .catch(error => {
                console.log(error);
            });
        } 
    }

    function previewFile(data) {
        let imgLoadingPreview = document.getElementById("img-preview");
        imgLoadingPreview.remove();
        let div = document.createElement('div');
        div.classList.add("d-flex");
        div.classList.add("align-items-center");
        div.style.height = "60px";

        let img = document.createElement('img');
        img.src = data.file.url;
        img.width = "60";

        let a = document.createElement('a');
        a.href = '#';
        a.classList.add("btn");
        a.classList.add("btn-danger");
        a.classList.add("float-right");
        a.setAttribute("onclick","delete_img(this, "+ data.file.id +");");
        a.title = 'Xóa';

        let i = document.createElement('i');
        i.classList.add("fa");
        i.classList.add("fa-trash");
        a.appendChild(i);
        div.appendChild(img);
        div.appendChild(a);

        let divImgPreview = document.createElement('div');
        divImgPreview.setAttribute('id', 'img-preview');
        divImgPreview.style.marginTop = "10px";
        divImgPreview.appendChild(div);
        document.getElementById('x_content').appendChild(divImgPreview);
        // console.log(data);
    }

    function previewError(data) {
        let imgLoadingPreview = document.getElementById("img-preview");
        imgLoadingPreview.remove();
        let div = document.createElement('div');
        div.classList.add("d-flex");
        div.classList.add("gbay-error");
        div.classList.add("align-items-center");
        div.innerText = data.errors.file;
        document.getElementById('x_content').appendChild(div);
        // console.log(data);
    }

    files.addEventListener('change', (input) => {
        let TotalFiles = files.files.length;
        handleFiles(files.files)

    });

    function handleFiles(files) {
        files = [...files]
        initializeProgress(files.length) // <- Add this line                
        files.forEach(uploadFile);
        // files.forEach(previewFile);
    };

    function loading() {
        let divImgPreview = document.createElement('div');
        divImgPreview.setAttribute('id', 'img-preview');
        divImgPreview.style.marginTop = "10px";
        let div = document.createElement('div');
        div.classList.add("img-loading");
        div.setAttribute('id','img-loading');
        let div1 = document.createElement('div');
        let div2 = document.createElement('div');
        let div3 = document.createElement('div');
        let div4 = document.createElement('div');
        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        divImgPreview.appendChild(div);

        document.getElementById('x_content').appendChild(divImgPreview);
    }

    function uploadFile(file) {
        loading();
        let formData = new FormData();
        formData.append('file', file);
        postUploadData('/admin/uploads/upload-new', formData, true)
        .then(function(data) {            
            if(data.success === true) {
                progressDone();
                previewFile(data);
            } else {
                // console.log(data);
                previewError(data);
            }            
        })
        .catch(error => {
            console.log(error);
        });
    }
});
</script>
@endsection