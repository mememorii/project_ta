<?php if (session()->get('role') == 1 || session()->get('role') == 2) {  ?>
    <?= $this->extend('layouts/master') ?>
<?php }else{ ?>
    <?= $this->extend('layout_user/master') ?>
<?php } ?>
    <?= $this->section('content') ?>
        <?php if (session()->get('role') == 1 || session()->get('role') == 2) {  ?>
            <div class="container-fluid">
        <?php }else{ ?>
            <div class="container-fluid" style="padding-left:99px;padding-right:99px">
        <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit User Account</h3>
                    </div>
                    <div class="card-body">
                            <hr>
                            <?php $validation = \Config\Services::validation(); ?>
                            <?php if (session()->get('success')) : ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <?= session()->get('success'); ?>
                                </div>
                            <?php endif; ?>                
                            <form class="" action="<?= base_url() ?>user/update" method="post">
                                <input type="hidden" class="form-control" name="id" id="id" value="<?= $user['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">    
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="">
                                            <?php if ($validation->getError('password')) { ?>
                                                <div class='alert alert-danger mt-2'>
                                                    <?= $error = $validation->getError('password'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">    
                                        <div class="form-group">
                                            <label for="password_confirm">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                                            <?php if ($validation->getError('password_confirm')) { ?>
                                                <div class='alert alert-danger mt-2'>
                                                    <?= $error = $validation->getError('password_confirm'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-12 col-sm-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
    <?= $this->endSection()?>







     