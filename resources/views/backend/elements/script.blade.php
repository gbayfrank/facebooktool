<script src="{{ asset('/backend/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/backend/vendors/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('/backend/vendors/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('/backend/build/js/custom.js') }}"></script>
<script src="{{ asset('/backend/js/gbay.js') }}"></script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    async function postUploadData(url, data, file = false) {
        // Default options are marked with *
        const token = document.getElementsByName('csrf-token')[0].content;
        let data_new = data;
        let headers = {
                'X-CSRF-TOKEN': token
            }
        if(file === false) {
            data_new = JSON.stringify(data);
            headers = {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            }
        }            
        const response = await fetch(url, {
            method: 'POST',
            headers: headers,
            body: data_new, 
        });
        return response.json(); 
    }
    async function getData(url) {
        // Default options are marked with *
        const token = document.getElementsByName('csrf-token')[0].content;
        let headers = {
                'X-CSRF-TOKEN': token
            }           
        const response = await fetch(url, {
            method: 'GET',
            headers: headers,
        });
        return response.json(); 
    }
</script>