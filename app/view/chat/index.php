

<!-- <div class="chat-container"> -->
  <div class="conversation">
    <div id="mensagens" class="conversation-container"></div>
    <form id="form_msg" class="conversation-compose">
        <?php if (isset($_SESSION['id'])) { ?>
            <input id="mensagem" class="input-msg" name="input" placeholder="Escreva uma mensagem..." autocomplete="off" autofocus>
        <?php } else { ?>
            <input id="mensagem" class="input-msg" name="input" placeholder="Escreva uma mensagem..." autocomplete="off" autofocus>  
        <?php } ?>
        <button type="submit" class="send" onclick="playSound()">
            <div class="circle">
                <i class="zmdi zmdi-mail-send"></i>
            </div>
        </button>
    </form>
  </div>
<!-- </div> -->



