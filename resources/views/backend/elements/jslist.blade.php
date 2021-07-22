<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const delete_items = document.getElementById('delete_items');

    delete_items.onclick = () => {
        const itemNumber = $(".bulk_action input[name='items[]']:checked");
        const url = "{{ route($controllerName . '.delete-items') }}";
        if(itemNumber.length) {
            const r = confirm("Bạn chắc chắn muốn xóa!");
            if(r == true) {   
                let inputData   = {};
                let data        = [];
                for(let i = 0; i < itemNumber.length; i++) {
                    data.push(itemNumber[i].value); 
                }
                inputData._token    = token;
                inputData.id        = data;

                postData(url, inputData)
                .then(data => {
                    console.log(data); // JSON data parsed by `data.json()` call
                    if(data.success === true) {
                        window.location.href  = window.location.href;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
        } else {
            alert('Để thực hiện, bạn phải chọn ít nhất 1 phần tử.');
        }
    }
    // Xử lý khi thay đổi số phần tử 
    const gbay_number_items = document.getElementById('gbay_number_items');
        gbay_number_items.onchange = () => {
            const number_items    = gbay_number_items.value;
            const searchString    = window.location.href;
            const check_number_items = /number_items=[\d]{1,2}/g;
            let searchStringNew = '';
            if(searchString.search(check_number_items) != -1) {
                searchStringNew = searchString.replace(check_number_items, 'number_items=' + number_items);
            } else {
                const check_page = /(page=[\d]{1,2})/g;
                if(searchString.search(check_page) != -1) {
                    searchStringNew = searchString.replace(check_page, '$1&number_items=' + number_items);
                } else {
                    let pathname = window.location.pathname.replace(/\//g, '\\/');
                    let pathname_regex = new RegExp('(' + pathname + ')', 'g');
                    searchStringNew = searchString.replace(pathname_regex, '$1?number_items=' + number_items);
                }                
            }
            window.location.href = searchStringNew;
        }
    });

    async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
        method: 'POST',
        mode: 'cors', 
        cache: 'no-cache', 
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        redirect: 'follow', 
        referrerPolicy: 'no-referrer', 
        body: JSON.stringify(data) 
        });
        return response.json(); 
    }
    const btn_search_field = document.getElementById('btn_search_field');
    btn_search_field.onclick = () => {
        const search_value = document.getElementById('search_value');
        const search_field = document.getElementById('search_field');
        const urlOld    = window.location.href;
        let urlMain = '';
        if(search_value.value !== '') {
            const check_search_field = /search_field=(\w+)/g;
            const check_search_value = /search_value=(.*)/g;
            // Xu ly search field
            if(urlOld.search(check_search_field) !== -1) {
                urlMain = urlOld.replace(check_search_field, 'search_field=' + search_field.value);           
            } else {
                let dau = '&';
                if(window.location.search === '') {
                    dau = '?';
                }
                urlMain = urlOld + dau + 'search_field=' + search_field.value;
            }

            // Xu ly search value
            if(urlOld.search(check_search_value) !== -1) {
                urlMain = urlOld.replace(check_search_value, 'search_value=' + search_value.value);            
            } else {
                urlMain += '&search_value=' + search_value.value;
            }
            window.location.href = urlMain;
        } else {
            alert('Bạn cần nhập chuỗi cần tìm!');
        }
    }

    slugify = (string) => {
        const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
        const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
        const p = new RegExp(a.split('').join('|'), 'g')
        return string.toString().toLowerCase()
            .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            .replace(/đ/gi, 'd')
            .replace(/\s+/g, '-') 
            .replace(p, c => b.charAt(a.indexOf(c)))
            .replace(/&/g, '-and-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '')
    }
</script>