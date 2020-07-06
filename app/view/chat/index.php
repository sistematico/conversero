

<!-- <div class="chat-container"> -->
  <div class="conversation">
    <div id="mensagens" class="conversation-container"></div>
    <form id="form_msg" class="conversation-compose">
        <?php if (isset($_SESSION['id'])) { ?>
            <input id="mensagem" class="input-msg" name="input" placeholder="Escreva uma mensagem..." autocomplete="off" autofocus>
            <button type="submit" class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
        <?php } else { ?>
            <span id="loginlink">Login</span>
            <span id="cadastrolink" style="display:none">Cadastro</span>
            <input id="usuario" placeholder="Usuário" autofocus>  
            <input id="senha" placeholder="Senha">  
            <button class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
        <?php } ?>
    </form>
  </div>
<!-- </div> -->



