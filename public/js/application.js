let userid, nome;

$(function() {
    $.ajax({
        url: url + 'users/logged',
        success: function(data) {
            if (data != 'false') {
                userid = data;
                $('#cadastroform').hide()
                $('#loginform').hide();
                $('#form_msg').show();
            } else {
                $('#cadastroform').hide()
                $('#loginform').show();
                $('#form_msg').hide();
            }
        }
    });

    $('#linksair').on('click', function(){

        $.ajax({ 
            url: url + 'users/logout',
            success: function(data) { }
        });

    });

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
                    if (data != 'false') {
                        data = JSON.parse(data);
                        $('#cadastroform').hide();
                        $('#loginform').hide();
                        $('#form_msg').show();
                        nome = data.nome;
                        userid = data.id;
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
                    if (data != 'false') {
                        $('#loginform').show();
                        $('#cadastroform').hide();
                        $('#form_msg').hide();
                    }
                }
            });
        }
    });

    $('#form_msg').on('submit', function(e) {
        e.preventDefault();
        let elmnt = document.getElementById('mensagens');
        elmnt.scrollTop = elmnt.offsetHeight;
        if ($('#mensagem').val().length > 0) {
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
            if (userid == item.idusuario) {
                result += '<div class="message sent">';
            } else {
                result += '<div class="message received">';
            }
            result += '<span style="color: ' + item.cor + '">' + item.usuario + '</span>'; 
            result += '<br />';
            result += item.mensagem;
            result += '<span class="metadata">';
            result += '<span class="time">' + moment.unix(item.timestamp).format('h:mm A') + '</span><span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg></span>';
            result += '</span>';
            result += '</div>';
        });
        $('#mensagens').html(result);
    });
}, 1500);

function playSound(){
    let audio = new Audio(url + "snd/incoming.mp3");
    audio.play();
}

function logged() {
    $.ajax({
        url: url + 'users/logged',
        success: function(data) {
            return data;
        }
    });
}