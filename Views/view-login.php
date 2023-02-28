<?php include "../includes/head.php"; ?>

<main>
    <div class="row login justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Connexion</h5>
                    <div class="row justify-content-center">
                        <div class="col-8 m-3">

                            <!-- Login -->
                            <div class="input-group m-1">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-person-circle"></i></div>
                                <input type="text" class="form-control" placeholder="Login" aria-label="Input group example" aria-describedby="btnGroupAddon" name="login">
                            </div>
                            
                            <!-- Password -->
                            <div class="input-group m-1">
                                <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-shield-lock"></i></div>
                                <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Input group example" aria-describedby="btnGroupAddon" name="password">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit -->
                    <button class="btn btn-primary m-3" type="submit">se connecter</button>
                </div>
            </div>
        </div>
    </div>

</main>




<?php include "../includes/footer.php"; ?>