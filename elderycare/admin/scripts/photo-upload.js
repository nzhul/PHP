$(document).ready(function() {
    $('#photoimg').on('change', function(){
        $("#crop-field").html('');
        $("#crop-field").html('Loading ...');
        $("#imageform").ajaxForm({
            target: '#crop-field',
            success: function(){
                jQuery(function($){
                    $('#target').Jcrop({
                        onSelect: updateCoords,
                        boxWidth: 800,
                        aspectRatio: 350/250
                    });
                });

                $("#crop-image-btn").click(function(event){
                    event.preventDefault();
                    if(parseInt($('#w').val())){
                        $.ajax({
                            url: 'ajax_process_crop.php',
                            type: 'POST',
                            data:{
                                x:$('#x').val(),
                                y:$('#y').val(),
                                w:$('#w').val(),
                                h:$('#h').val(),
                                tempimgsrc:$("#target").attr("src")
                            }
                        }).done(function(data){
                            $('.product_thumb img').attr('src', data)
                            var filename = data.split('/').pop();
                            $('#photo-hidden-field').val(filename);

                            $("#crop-field").html('<h3 class="success-upload">Картикната беше качена успешно!</h3><div style="clear:both;"></div>');
                        }).fail(function(){
                            $("#crop-field").html('<div id="avatar_bg"><h3 style="text-align:center;margin: 50px 0 50px -40px;color:red;">Възникра неочаквана грешка<br/>Моля свържете се с администратор!</h3><div style="clear:both;">&nbsp;</div></div>');
                        })
                    }
                });

                function updateCoords(c)
                {
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                };
            }
        }).submit();
    });
});