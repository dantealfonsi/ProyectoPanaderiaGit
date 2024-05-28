<head>
    <script defer src="validateContactInput.js"></script>
</head>

<div id="contact-submission" class="contact-section">
    <div class="contact-us">
        <div class="subtitle">
            <h2>CONTACTANOS</h2>
            <p>TEXTO GENERICO QUE JUAN DECIDIRA.</p>
            <span class="send-input-message"></span>
            <span id="sendError" class="input-error"></span>
        </div>

        <form id="formularioContacto" method="POST" >
            <label for="nombreCliente">Nombre <em>&#x2a;</em></label>
            <span id="nombre_error"class="input-error"></span>
            <input id="nombreCliente" name="nombreCliente" required type="text" />

            <label for="correoCliente">EMAIL <em>&#x2a;</em></label>
            <span id="correo_error" class="input-error"></span>
            <input id="correoCliente" name="correoCliente" required type="email" />

            <label for="telefonoCliente">TELÉFONO</label>
            <span id="telefono_error" class="input-error"></span>
            <input id="telefonoCliente" name="telefonoCliente" type="tel"/>
            
            <label for="numeroPedido">Numero de Pedido</label>
            <input id="numeroPedido" name="numeroPedido" type="text" />
            
            <label for="notaCliente">Tu mensaje <em>&#x2a;</em></label>
            <span class="input-error"></span>
            <textarea id="notaCliente" name="mensajeCliente" required rows="4"></textarea>
            <br>

            <div class="push-button">
                <span><button id="submit" name="submit">Enviar</button></span>
            </div>
        </form>
    </div>
</div>