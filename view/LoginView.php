<?php
include_once '../public/header.php';
include_once '../util/RSA.php';
include_once '../util/SSession.php';

SSession::getInstance()->keys = RSA::getInstance()->keygen();
$keyPublicHex = RSA::getInstance()->publicKeyToHex(SSession::getInstance()->keys['privatekey']);
?>

<table>
    <tr>
        <th>Correo</th>
        <th>Contrase&ncaron;a</th>

    </tr>
    <form enctype="multipart/form-data" onsubmit="validate(); return false">
        <tr>
            <td>
                <input type ='text' name="loginMail" id="loginMail" placeholder="correo@proveedor.dominio" required/>
            </td>
            <td>
                <input type ='password' name="loginPassword" id="loginPassword" placeholder="*******" required/>
            </td>

            <td>
                <input type="submit" name="login" value="Login"/> 
            </td>
            <td>
                <a href="RecoverPasswordView.php">Recuperar contrasena</a>
            </td>

        </tr>
    </form>

    <tr>
        <td></td>
        <td>
            <div id="state"></div>
        </td>
    </tr>
</table>

<script src="../public/js/RSA/jsbn.js"></script>
<script src="../public/js/RSA/jsbn2.js"></script>
<script src="../public/js/RSA/prng4.js"></script>
<script src="../public/js/RSA/rng.js"></script>
<script src="../public/js/RSA/rsa.js"></script>
<script src="../public/js/RSA/rsa2.js"></script>


<script>
        function encrypt(data) {
            var publickey = "<?= $keyPublicHex; ?>";
            var rsakey = new RSAKey();
            rsakey.setPublic(publickey, "10001");
            return rsakey.encrypt(data);
        }

        function validate() {
            var args = {
                "loginMail": encrypt($("#loginMail").val()),
                "loginPassword": encrypt($("#loginPassword").val()),
                "login": "login"
            };

            $.post('../business/LoginBusiness.php', args, function (data) {
                if (data.result === 1) {
                    $("#state").html(message["success"]);
                    location.href = '../index.php';
                } else if (data.result === -1) {
                    $("#state").html(message["format"]);
                } else if (data.result === -2) {
                    $("#state").html(message["emptyField"]);
                } else {
                    $("#state").html(message["fail"]);
                }
            }, 'json').fail(function () {
                alert('Error de Envio');
            });
        }

</script>

<?php
include_once '../public/footer.php';
