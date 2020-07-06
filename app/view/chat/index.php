

<div class="chat-container">





<div class="user-bar">
              <div class="back">
                <i class="zmdi zmdi-arrow-left"></i>
              </div>
              <div class="avatar">
                <img src="<?php echo URL; ?>img/avatar.png" alt="Avatar">
              </div>
              <div class="name">
                <span>Conversero</span>
                <span class="status">online</span>
              </div>
              <div class="actions more">
                <i class="zmdi zmdi-more-vert"></i>
              </div>
              <div class="actions attachment">
                <i class="zmdi zmdi-phone"></i>
              </div>

              <div class="actions">
                

                <div class="dropdown" style="float:right;">
  <button class="dropbtn"><i class="zmdi zmdi-mail-reply"></i></button>
  <div class="dropdown-content">
  <a href="#">Link 1</a>
  <a href="#">Link 2</a>
  <a href="#">Link 3</a>
  </div>
</div>
              </div>

              <div class="actions">
                <img src="https://i.ibb.co/LdnbHSG/ic-action-videocall.png"/>             
              </div>

              


            </div>





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



