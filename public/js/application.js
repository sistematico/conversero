$(function() {
    $('#formmensagens').on('submit', function(e){
        e.preventDefault();
        if ($('#mensagem').val().length > 0) {
            $.post(url + "chat/add",{ mensagem: $("#mensagem").val() }, function(data) {
                if (data) {
                    $('#mensagem').val('');
                }
            });
        }
    });
});

setInterval(() => {
    $.ajax(url + "/chat/list").done(function(data) {
        let result = '';
        data = $.parseJSON(data);
        data.reverse();       
        $.each(data, function(key, item) {
            let hora = convertTimestamp(item.timestamp);
            result += '<div class="message sent">';
            if (item.usuario) {
                result += item.usuario
            } else {
                result += 'Anônimo';
            } 
            result += item.mensagem;
            result += '<span class="metadata">';
            result += '<span class="time">' + hora.moment().format('h:mm A') + '</span><span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg></span>';
            result += '</span>';
            result += '</div>';

        });
        $('#mensagens').html(result);
    });
}, 1000);

function strip(string) {
    var container = document.createElement('div');
    var text = document.createTextNode(string);
    container.appendChild(text);
    return container.innerHTML; // innerHTML will be a xss safe string
}

function convertTimestamp(timestamp) {
    var d = new Date(timestamp * 1000),	// Convert the passed timestamp to milliseconds
          hh = d.getHours(),
          h = hh,
          min = ('0' + d.getMinutes()).slice(-2),		// Add leading 0.
          ampm = 'AM',
          time;
              
      if (hh > 12) {
          h = hh - 12;
          ampm = 'PM';
      } else if (hh === 12) {
          h = 12;
          ampm = 'PM';
      } else if (hh == 0) {
          h = 12;
      }
      
      time = h + ':' + min + ' ' + ampm;
      return time;
}

function color() {
    let cores = ['#282a36','#44475a','#44475a','#f8f8f2','#6272a4','#8be9fd','#50fa7b','#ffb86c','#ff79c6','#bd93f9','#ff5555','#f1fa8c'];    
    let rdm = cores[Math.floor(Math.random() * cores.length)];
    return rdm;
}