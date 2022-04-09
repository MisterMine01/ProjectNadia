<?php
//GET: APPID, tempToken, URI
if (!isset($_GET["APPID"]) || !isset($_GET["tempToken"]) || !isset($_GET["URI"])) {
    echo "Missing arguments";
    die(1);
}
?>

<html>

<head>
    <title>Nadia-Connection</title>
</head>

<body>
    <div>
        <div class="partie">
            <?php
            if (isset($_GET["Error"])) {
                echo "<h1>Erreur: " . urldecode($_GET["Error"]) . "</h1>";
            }
            ?>
            <form method="POST" action="connection_exit.php">
                <input type="hidden" value=<?php echo "${_GET["APPID"]}";?> name="APPID">
                <input type="hidden" value=<?php echo "${_GET["tempToken"]}";?> name="tempToken">
                <input type="hidden" value=<?php echo "${_GET["URI"]}";?> name="URI">

                <?php if (isset($_GET["create"])) { ?>
                    <h1>CREER UN COMPTE</h1>
                    <input type="hidden" value="create" id="type" name="type">
                <?php } else { ?>
                    <h1>CONNEXION A UN COMPTES</h1>
                    <input type="hidden" value="connect" id="type" name="type">
                <?php } ?>
                <br>
                <p>Nom d'utilisateur: <input type="text" id="user" name="user"></p>
                <p>Mot de passe: <input type="password" id="pass" name="pass"></p>

                <?php if (isset($_GET["create"])) { ?>
                    <p>Répéter le mot de passe: <input type="password" id="pass2" name="pass2"></p>
                <?php } ?>

                <input type="submit" value=<?php
                                            if (!isset($_GET["create"])) {
                                                echo "Connexion";
                                            } else {
                                                echo "Creer le compte";
                                            } ?>>
            </form>
            <script>
                function removeURLParameter(url, parameter) {
                    //prefer to use l.search if you have a location/link object
                    var urlparts = url.split('?');
                    if (urlparts.length >= 2) {

                        var prefix = encodeURIComponent(parameter) + '=';
                        var pars = urlparts[1].split(/[&;]/g);

                        //reverse iteration as may be destructive
                        for (var i = pars.length; i-- > 0;) {
                            //idiom for string.startsWith
                            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                                pars.splice(i, 1);
                            }
                        }

                        return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
                    }
                    return url;
                }
            </script>
            <?php if (isset($_GET["create"])) { ?>
                <button onclick="location.href  = removeURLParameter(location.href, 'create')">Connexion a un compte</button>
            <?php } else { ?>
                <button onclick="location.href  += '&create=true'">Creer un compte</button>
            <?php } ?>
        </div>
    </div>
    <script src="Site/js/connection.js"></script>
</body>

</html>