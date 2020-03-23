
<?php
header("Content-Type: text/html;charset=utf-8");
?>
<script type="text/javascript" src="jquery.min.js"></script>
<script>
    setInterval("test()",10000);
    function test() {
        $.ajax({
            url: '/new_window_url/',
            async:true,
            type: 'get',
            success: function (data) {
                var new_url =  $('#new_iframe').attr('src');
                if (new_url !== data){
                    $('#new_iframe').attr('src', data);
                }
            }
        })
    }
</script>