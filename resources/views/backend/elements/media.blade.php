<div class="modal fade bd-modal-lg" tabindex="-1" role="dialog" id="media-modal" aria-labelledby="mediaModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:95%;background-color:#fff;max-width:unset;">
        <div class="modal-header">
            <h5 class="modal-title" id="mediaLabel">Thư viện</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-content">
            <ul class="nav nav-tabs bar_tabs" id="mediaTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="general" aria-selected="true">Tải lên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="media-tab" data-toggle="tab" href="#media" role="tab" aria-controls="media" aria-selected="false">Thư viện</a>
                </li>
            </ul>
            <div class="tab-content" id="mediaTabContent" style="padding:15px;">
                <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
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
                <div class="tab-pane fade active show" id="media" role="tabpanel" aria-labelledby="media-tab">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 form-group has-feedback">
                                            <div class="row">
                                                <div class="gbay-select mr-15" id="field_date"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row" id="show_media_search">                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row" id="media-items">
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="row" id="footer_media">                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <h4>Thông tin</h4>
                            <div id="info_file"></div>                                
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="hidden" name="info_hidden" id="info_hidden" value="">
            <input type="hidden" name="id_input" id="id_input" value="">
            <input type="hidden" name="input_preview" id="input_preview" value="">
            <input type="hidden" name="input_file_id" id="input_file_id" value="">
            <input type="hidden" name="id_file" id="id_file" value="">
            <button type="submit" class="btn btn-primary">Chọn</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
        </div>
    </div>
</div>
<style>
    .media-delete {
        color: red;
        cursor: pointer;
    }
    .gbay-line {
        border-bottom: 2px dashed #b4b9be;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fileTmp    = ['gif', 'svg'];
        const website    = "{{ env('APP_URL', 'http://localhost') }}";

        media_show = (element_id, id_preview = '', id_element_input_id = '') => {
            document.cookie = 'page=1';
            document.cookie = 'dir_date=all';
            document.cookie = 'search_field=all';
            document.cookie = 'search_value=';
            load_data();
            $('#media-modal').modal('show');
            const id_input = document.getElementById('id_input');
            id_input.value = element_id;
            if(id_preview !== '') {
                const input_preview = document.getElementById('input_preview');
                input_preview.value = id_preview;
            }
            if(id_element_input_id !== '') {
                const input_file_id = document.getElementById('input_file_id');
                input_file_id.value = id_element_input_id;
            }
        }

        load_data = () => {
            let url = "{{ route($controllerUpload . '.get-data') }}";  
            // alert(getCookie('dir_date'));
            url = `${url}?page=${getCookie('page')}&dir_date=${getCookie('dir_date')}&search_field=${getCookie('search_field')}&search_value=${getCookie('search_value')}`;
            getDataUploads(url);
        }

        getDataUploads = (url) => { 
            getData(url)
            .then(data => {
                // console.log(data);
                show_media_items(data.data.items.data);
                show_field_date(data.data.dirDate);
                // show_search();
                show_pagination(data.data.items);
            })
            .catch(error => {
                console.log(error);
            });
        }
        // Hiển thị bộ lọc theo thời gian
        show_field_date = (data) => {
            const field_date = document.getElementById('field_date');
            let html = '';
            let optionHtml = '';
            let optionAll = '';
            if(getCookie('dir_date') === 'all') {
                optionAll = `<option value="all" selected>Tất cả</option>`;
            } else {
                optionAll = `<option value="all">Tất cả</option>`;
            }
            for(let i = 0; i < data.length; i++) {
                if(getCookie('dir_date') === data[i]) {
                    optionHtml += `<option value="${data[i]}" selected>${data[i]}</option>`;
                } else {
                    optionHtml += `<option value="${data[i]}">${data[i]}</option>`;
                }
            }
            html = `<label>
                        Thời gian
                        <select name="gbay_checkbox_date" id="gbay_checkbox_date" class="form-control input-sm" onchange="change_dir_date(this)">
                            ${optionAll}                             
                            ${optionHtml}
                        </select>
                    </label>`;
            field_date.innerHTML = html;
        }

        // Hiển thị bộ tìm kiếm
        show_search = () => {
            const show_media_search = document.getElementById('show_media_search');
            let html = '';
            html = `<div class="input-group gbay-search">
                        <label>
                            <select name="search_field" id="search_field" class="form-control input-sm">
                                <option value="all">Tất cả</option>
                                <option value="name">Tên</option>
                                <option value="alt">Alt</option>
                                <option value="caption">Caption</option>
                                <option value="content">Content</option>
                            </select>
                        </label>
                        <input type="text" class="form-control" name="search_value" id="search_value" placeholder="Tìm..." />
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" id="btn_search_field" onclick="btn_search_field()" type="button">Tìm!</button>
                        </span>
                    </div>`;
            
            show_media_search.innerHTML = html;
        }

        btn_search_field = () => {
            const search_value = document.getElementById('search_value');
            const search_field = document.getElementById('search_field');
            if(search_value.value !== '') {
                document.cookie = 'search_field=' + search_field;
                document.cookie = 'search_value=' + search_value;
                load_data();
            } else {
                alert('Bạn cần nhập chuỗi cần tìm!');
            }
        }

        // Hiển thị pagination
        show_pagination = (items) => {
            const footer_media = document.getElementById('footer_media');
            let html = '';
            if(items.last_page > 1) {
                let first_li = '';
                if(items.links[0].url === null) {
                    first_li = `<li class="paginate_button disabled"><span>&laquo;</span></li>`;
                } else {
                    first_li = `<li class="paginate_button previous"><a onclick="getDataUploads('${items.links[0].url}')" rel="prev" style="cursor:pointer;">&laquo;</a></li>`;
                }
                let li = '';
                for(let i = 1; i < items.links.length - 1; i++) {
                    if(items.links[i].url === null) {
                        li += `<li class="paginate_button disabled"><span>${items.links[i].label}</span></li>`;
                    } else {
                        if(items.links[i].active === true) {
                            li += `<li class="paginate_button active"><span>${items.links[i].label}</span></li>`;
                        } else {
                            li += `<li class="paginate_button"><a onclick="getDataUploads('${items.links[i].url}')" style="cursor:pointer;">${items.links[i].label}</a></li>`;
                        }
                    }
                }
                let last_li = '';
                if(items.links[items.links.length - 1].url === null) {
                    last_li = `<li class="paginate_button disabled"><span>&raquo;</span></li>`;
                } else {
                    last_li = `<li class="paginate_button next"><a onclick="getDataUploads('${items.links[items.links.length - 1].url}')" style="cursor:pointer;" rel="prev">&raquo;</a></li>`;
                }
                html = `<div class="col-sm-12 col-md-5">
                        <div class="gbay_table_info">Hiển thị từ ${items.from} tới ${items.to} của ${items.total} ảnh</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="gbay_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                ${first_li}        
                                <!-- Pagination Elements -->
                                ${li}        
                                <!-- Next Page Link -->
                                ${last_li}
                            </ul>
                        </div>
                    </div>`;
            }
            
            footer_media.innerHTML = html;
        }

        change_dir_date = (obj) => {
            dir_date = obj.value;
            document.cookie = 'dir_date=' + dir_date;
            load_data();
        }
        // Hiển thị danh sách phần tử
        show_media_items = (items) => {
            // console.log(items);
            const mediaItems = document.getElementById('media-items');       
            // media-active
            html = '';
            let first_id = '';
            for(let i = 0; i < items.length; i++) {
                if(i === 0) first_id = items[i].id;
                // console.log(items[i]);
                if(fileTmp.includes(items[i].extension)) {
                    url = `${website}/systems/${items[i].extension}.png`;
                } else {
                    url = `${website}/uploads/${items[i].dir_date}/${items[i].name_not_extension}-150x150.${items[i].extension}`;
                }
                html += `<div class="col-md-2" style="margin-bottom:10px;" onclick="info_item(${items[i].id})">
                            <div class="thumbnail" id="${items[i].id}">
                                <div class="image view view-first">
                                    <img style="width:100%;display:block;" src="${url}" />
                                </div>
                            </div>
                        </div>`;
            }
            mediaItems.innerHTML = html;
            info_item(first_id);
        }

        info_item = (id) => {
            const url = "{{ route($controllerUpload . '.get-info-item') }}";
            const info_file = document.getElementById('info_file');
            const id_file   = document.getElementById('id_file');
            id_file.value = id;
            // Lấy ra danh sách các thumbnail sau đó xóa class media-active
            let thumbnails = document.getElementsByClassName('thumbnail');
            for(let i = 0; i < thumbnails.length; i++) {
                thumbnails[i].classList.remove("media-active");
            }
            // Thêm mới class vào media-active
            const thumbnail = document.getElementById(id).classList.add("media-active");
            postUploadData(url,{id: id})
            .then(data => {
                if(data.success === true)    {
                    let html = '';
                    if(fileTmp.includes(data.item.extension)) {
                        urlfile = `${website}/systems/${data.item.extension}.png`;
                    } else {
                        urlfile = `${website}/uploads/${data.item.dir_date}/${data.item.name_not_extension}-150x150.${data.item.extension}`;
                    }
                    const alt       = (data.item.alt !== null) ? data.item.alt : '';
                    const title     = (data.item.title !== null) ? data.item.title : '';
                    const caption   = (data.item.caption !== null) ? data.item.caption : '';
                    const content   = (data.item.content !== null) ? data.item.content : '';
                    html = `<img src="${urlfile}">
                                <div>Tải lên vào: <strong>${data.item.created_at}</strong></div>
                                <div>Tải lên bởi: <strong>${data.item.created_by_id}</strong></div>
                                <div>Tên file: <strong>${data.item.name}</strong></div>
                                <div><strong class="media-delete" onclick="delete_media(${data.item.id});">Xóa vĩnh viễn</strong></div>
                                <div class="gbay-line"></div>
                                <div class="alert alert-dismissible " role="alert" id="media-alert" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong id="media-alert-text"></strong>
                                </div>
                                <p class="mrt-10">
                                    <label for="alt">Thẻ Alt:</label>
                                    <input type="text" id="alt" class="form-control" name="alt" value="${alt}" onblur="update_value(this, 'alt');">
                                <p>
                                <p class="mrt-10">
                                    <label for="title">Tiêu đề:</label>
                                    <input type="text" id="title" class="form-control" name="title" value="${title}" onblur="update_value(this, 'title');">
                                <p>
                                <p class="mrt-10">
                                    <label for="caption">Chú thích:</label>
                                    <input type="text" id="caption" class="form-control" name="caption" value="${caption}" onblur="update_value(this, 'caption');">
                                <p>
                                <p class="mrt-10">
                                    <label for="content">Nội dung:</label>
                                    <input type="text" id="content" class="form-control" name="content" value="${content}" onblur="update_value(this, 'content');">
                                <p>
                                <p class="mrt-10">
                                <label for="url">Url:</label>
                                <input type="text" id="url" class="form-control" name="url" value="${data.item.url}">
                                </p>
                                <button class="btn btn-primary" type="button" style="margin-top:5px;" onclick="copyUrl()">Copy vào bộ nhớ tạm</button>`;
                    info_file.innerHTML = html;
                    const info_hidden = document.getElementById('info_hidden');
                    info_hidden.value = data.item.url;
                }            
                
            })
            .catch(error => {

            });
        }

        // Update value
        update_value = (obj, colum) => {
            const url = "{{ route($controllerUpload . '.ajax-update-input') }}";
            const id_file   = document.getElementById('id_file');
            id_item = id_file.value;
            data = {
                id: id_item,
                value: obj.value,
                colum: colum
            };
            postUploadData(url,data)
            .then(data => {
                console.log(data);
                if(data.success === true) { 
                    const media_alert = document.getElementById('media-alert');
                    const media_alert_text = document.getElementById('media-alert-text');
                    media_alert_text.innerText = 'Cập nhật thành công!';
                    media_alert.classList.add('alert-success');
                    media_alert.style.display = 'block';
                    setTimeout(() => { 
                        media_alert.style.display = 'none';
                    }, 15000);
                }
            })
            .catch(error => {
                const media_alert = document.getElementById('media-alert');
                const media_alert_text = document.getElementById('media-alert-text');
                media_alert_text.innerText = 'Cập nhật thất bại!';
                media_alert.classList.add('alert-danger');
                media_alert.style.display = 'block';
                setTimeout(() => { 
                        media_alert.style.display = 'none';
                }, 15000);
            });
        }

        // Xóa file
        delete_media = (id) => {
            const c = confirm("Bạn chắc chắn muốn xóa");
            if(c == true) {
                const url = "{{ route($controllerUpload . '.ajax-delete') }}";
                postUploadData(url, {id : id})
                .then(function(data) {
                    load_data();
                    console.log(data);
                    // obj.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
                })
                .catch(error => {
                    console.log(error);
                });
            } 
        }
        // Chèn url vào ô Input được chọn
        $('#media-modal').on('hidden.bs.modal', function (e) {
            const url_file = document.getElementById('info_hidden').value;
            const id_preview = document.getElementById('input_preview').value;
            const input_file_id = document.getElementById('input_file_id').value;
            const id_file = document.getElementById('id_file').value;
            if(url_file) {
                // $('#media-modal').modal('hide'); 
                const id_input = document.getElementById('id_input').value;
                const element  = document.getElementById(id_input); 
                element.value = url_file;

                if(id_preview !== '') {
                    const img_preview = document.getElementById(id_preview);
                    img = `<img src="${url_file}" width="100%">`;
                    img_preview.innerHTML = img;
                }

                if(input_file_id !== '') {
                    const input_file_value_id = document.getElementById(input_file_id);
                    input_file_value_id.value = id_file;
                }
            } else {
                alert('Bạn cần chọn 1 ảnh')
            }
        });

        copyUrl = () => {
            let url = document.getElementById("url");
            url.select();
            url.setSelectionRange(0, 99999);

            document.execCommand("copy");
        }

        setCookie = (cname, cvalue, exdays) => {
            let d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        getCookie = (cname) => {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    });
    
</script>