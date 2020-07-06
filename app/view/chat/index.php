

<!-- <div class="chat-container"> -->
  <div class="conversation">
    <div id="mensagens" class="conversation-container"></div>
        <?php if (isset($_SESSION['id'])) { ?>
            <form id="form_msg" class="conversation-compose">
                <input id="mensagem" class="input-msg" name="input" placeholder="Escreva uma mensagem..." autocomplete="off" autofocus>
                <button type="submit" class="send" onclick="playSound()">
                    <div class="circle">
                        <i class="zmdi zmdi-mail-send"></i>
                    </div>
                </button>
            </form>
        <?php } else { ?>
            <form id="cadastroform" class="conversation-compose" style="display:none">
            <span id="loginlink">Login</span>
            <input id="usuario" placeholder="Usuário" autofocus>  
            <input id="senha" placeholder="Senha">  
            <button class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
            </form>

            <form id="loginform" class="conversation-compose">
            <span id="cadastrolink">Cadastro</span>
            <input id="usuario" placeholder="Usuário" autofocus>  
            <input id="senha" placeholder="Senha">  
            <button class="send" onclick="playSound()">
                <div class="circle">
                    <i class="zmdi zmdi-mail-send"></i>
                </div>
            </button>
            </form>
        <?php } ?>
  </div>
<!-- </div> -->



