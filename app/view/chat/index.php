

<!-- <div class="chat-container"> -->
  <div class="conversation">
    <div id="mensagens" class="conversation-container"></div>
        <form id="form_msg" class="conversation-compose" style="display:none">
            <input id="mensagem" class="input-msg" name="input" placeholder="Escreva uma mensagem..." autocomplete="off" autofocus>
            <button type="submit" class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
        </form>

        <form id="cadastroform" class="conversation-compose" style="display:none">
            <span id="loginlink">Login</span>
            <input id="usuario_cadastro" placeholder="Usuário" autofocus>  
            <input id="senha_cadastro" placeholder="Senha">  
            <button class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
        </form>

        <form id="loginform" class="conversation-compose">
            <span id="cadastrolink">Cadastro</span>
            <input id="usuario_login" placeholder="Usuário" autofocus>  
            <input id="senha_login" placeholder="Senha">  
            <button class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
        </form>
  </div>
<!-- </div> -->



