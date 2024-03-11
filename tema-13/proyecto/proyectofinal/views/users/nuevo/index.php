<?php require_once("template/partials/head.php") ?>

<body>
    <?php require_once("template/partials/menuAut.php") ?>

    <!-- Page Content -->
    <div class="container">
        <br><br><br><br>

        <div class="row justify-content-center">

            <div class="col-md-8">
                <?php require_once("template/partials/notify.php") ?>
                <?php require_once("template/partials/error.php") ?>
                <div class="card">
                    <div class="card-header">Registro Usuarios</div>
                    <div class="card-body">
                        <form method="POST" action="<?= URL ?>/users/validate">

                            <!-- nombre -->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control <?= (isset($this->errores['name'])) ? 'is-invalid' : '' ?>"
                                        name="name" value="<?= isset($this->user->name) ? $this->user->name : '' ?>"
                                        required autocomplete="name" autofocus>
                                    <?php if (isset($this->errores['name'])): ?>
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['name'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- email -->
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control <?= (isset($this->errores['email'])) ? 'is-invalid' : '' ?>"
                                        name="email" value="<?= isset($this->user->email) ? $this->user->email : '' ?>"
                                        required autocomplete="email" autofocus>
                                    <?php if (isset($this->errores['email'])): ?>
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['email'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- password -->
                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control <?= (isset($this->errores['password'])) ? 'is-invalid' : '' ?>"
                                        name="password"
                                        value="<?= isset($this->user->password) ? $this->user->password : '' ?>"
                                        required autocomplete="new-password">
                                    <?php if (isset($this->errores['password'])): ?>
                                        <span class="form-text text-danger" role="alert">
                                            <?= $this->errores['password'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- password confirm -->
                            <div class="mb-3 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password-confirm"
                                        required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- campo rol -->
                            <div class="mb-3 row">
                                <label for="rol" class="col-md-4 col-form-label text-md-end">Rol</label>
                                <div class="col-md-6">
                                    <select id="rol"
                                        class="form-select <?= isset($this->errores['rol']) ? 'is-invalid' : '' ?>"
                                        name="rol" required>
                                        <option value="" disabled>Seleccione un rol</option>
                                        <?php foreach ($this->roles as $rol): ?>
                                            <option value="<?= $rol->id ?>" <?= isset($this->user->rol) && $this->user->rol == $rol->id ? 'selected' : '' ?>>
                                                <?= $rol->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($this->errores['rol'])): ?>
                                        <div class="invalid-feedback">
                                            <?= $this->errores['rol'] ?>
                                        </div>
                                    <?php elseif (empty($this->roles)): ?>
                                        <div class="text-danger">No hay roles disponibles</div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-secondary" href="<?= URL ?>users" role="button">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" formaction="<?= URL ?>users/validate"
                                        class="btn btn-primary">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once("template/partials/footer.php") ?>