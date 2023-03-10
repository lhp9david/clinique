<html>
<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>

<body>
    <?php include "../includes/head.php"; ?>
    <main>
        <div class="row login justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Connexion</h5>
                        <div class="row justify-content-center">
                            <div class="col-8 m-3">

                                <form action="" method="post">

                                    <!-- Login -->
                                    <div class="input-group m-1">
                                        <div class="input-group-text" id="btnGroupAddon"><?= $errorsArray['error'] ?? '<i class="bi bi-person-circle"></i>' ?></div>
                                        <input type="text" class="form-control" placeholder="Login" aria-label="Input group example" aria-describedby="btnGroupAddon" name="login">
                                    </div>

                                    <!-- Password -->
                                    <div class="input-group m-1">
                                        <div class="input-group-text" id="btnGroupAddon"><?= $errorsArray['error'] ?? '<i class="bi bi-shield-lock"></i>' ?></div>
                                        <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon" name="password">
                                    </div>

                                    <div class="g-recaptcha" data-sitekey="6Le8Y-gkAAAAAET4a0j0cageT9rpKpLWnIDrt1-2"></div>
                                    <?= $errorsArray['captcha'] ?? '' ?>


                                    <!-- Submit -->
                                    <button class="btn btn-primary m-3" type="submit">se connecter</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <?php include "../includes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 
</body>

</html>