$(function() {
    $('#loginlink').on('click', function(){
        $('#cadastroform').hide();
        $('#loginform').show();
    });

    $('#cadastrolink').on('click', function(){
        $('#loginform').hide();
        $('#cadastroform').show();
    });

    $('#loginform').on('submit', function(e) {
        e.preventDefault();
        if ($('#usuario_login').val().length > 0 && $('#senha_login').val().length > 0) {
            $.ajax({
                type     : 'POST',
                url      : url + 'users/login',
                data     : { 
                    usuario: $('#usuario_login').val(),
                    senha: $('#senha_login').val() 
                },
                success  : function(data) {
                    if (data) {
                        $('#loginform').hide();
                        $('#form_msg').show();
                    }
                }
            });
        }
    });

    $('#cadastroform').on('submit', function(e) {
        e.preventDefault();
        if ($('#usuario_cadastro').val().length > 0 && $('#senha_cadastro').val().length > 0) {
            $.ajax({
                type     : 'POST',
                url      : url + 'users/add',
                data     : { 
                    usuario: $('#usuario_cadastro').val(),
                    senha: $('#senha_cadastro').val() 
                },
                success  : function(data) {
                    if (data) {
                        $('#loginform').hide();
                        $('#form_msg').show();
                    }
                }
            });
        }
    });


    $('#form_msg').on('submit', function(e) {
        e.preventDefault();
        if ($('#mensagem').val().length > 0) {
            $.ajax({
                url: 'audio.txt',
                async: true,
                complete: function(resp) {
                    var res = resp['responseText'];
                    var audio=document.createElement('audio');
                    audio.src = res;
                    audio.play();                
                }
            });

            $.ajax({
                type     : 'POST',
                cache    : false,
                url      : url + 'chat/add',
                data     : { mensagem: $('#mensagem').val() },
                success  : function(data) {
                    if (data) {
                        $('#mensagem').val('');
                    }
                }
            });
        }
    });
});

setInterval(() => {
    $.ajax(url + 'chat/list').done(function(data) {
        let result = '';
        data = $.parseJSON(data);
        data.reverse();       
        $.each(data, function(key, item) {
            result += '<div class="message sent">';
            if (item.usuario) {
                result += item.usuario
            } else {
                result += 'Anônimo';
            } 
            result += '<br />';
            result += item.mensagem;
            result += '<span class="metadata">';
            result += '<span class="time">' + moment.unix(item.timestamp).format('h:mm A') + '</span><span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg></span>';
            result += '</span>';
            result += '</div>';

        });
        $('#mensagens').html(result);
    });
}, 1000);

function playSound(){
    $.ajax({
        type:'POST',
        url: url + 'chat/notification',
        data: { sound: url + 'snd/incoming.mp3' },
        async : true,
        success: function(resp){}
    });
}

function clearSound() {
    $.ajax({
        type:'POST',
        url: url + 'chat/notification',
        success: function(resp) { }
    });
}


setInterval(() => {
    $.ajax({
        url: 'audio.txt',
        async: true,
        complete: function(resp) {
            if (resp['responseText'] != '') {
                var res = resp['responseText'];
                var audio=document.createElement('audio');
                audio.src = res;
                audio.play();
                clearSound();
            }        
        }
    });
}, 1000);
