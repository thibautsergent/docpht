<?php

/**
 * This file is part of the DocPHT project.
 * 
 * @author Valentino Pesce
 * @copyright (c) Valentino Pesce <valentino@iltuobrand.it>
 * @copyright (c) Craig Crosby <creecros@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>

        <?php if (isset($_SESSION['Active'])) : ?>

            <?php $backupsList = $this->backupsModel->getBackups(); ?>
            
                  <div class="card bg-light text-dark mb-4 mt-4">
                    <div class="card-body text-center">
                    <p class="card-text"><?= $t->trans("Backup management") ?></p>
                    <form class="d-flex">
                        
                      <div class="input-group mb-2 mr-sm-2 mr-1">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><?= $t->trans("Backup") ?></div>
                        </div>
                        <select id="rbbackup" name="backup" class="custom-select" required>
                        <?php if (!empty($backupsList)) : ?>
                          <option value="" selected disabled><?= $t->trans("Select a backup") ?></option>
                        <?php else : ?>
                          <option value="" selected disabled><?= $t->trans("There are no backups") ?></option>
                        <?php endif ?>
                            <?php if (!empty($backupsList)) : ?>
                                  <?php foreach($backupsList as $backup) : ?>
                                        <option value="<?= $backup['path'] ?>"><?= date(DATAFORMAT, $backup['date']) ?></option>
                                  <?php endforeach; ?>
                            <?php endif ?>
                        </select>
                      </div>
                      <?php if (!empty($backupsList)) : ?>
                        <button type="button" form="rb" class="btn btn-primary mb-2 mr-2 text-light" data-toggle="modal" data-toggle="tooltip" data-placement="bottom" data-target="#confirmRestore" title="<?= $t->trans("Restore backup") ?>" title="<?= $t->trans("Restore backup") ?>">
                          <i class="fa fa-window-restore" aria-hidden="true"></i>
                        </button>
                      <?php endif ?> 
                      
                      </form>

                    <?php if (!empty($backupsList)) : ?>
                      <form id="rmb" action="admin/mrestore-backup" method="post" class="d-flex">
                      <input type="hidden" id="rmbhidden" name="backup">
                      </form>
                      
                      <form id="crb" action="admin/crestore-backup" method="post" class="d-flex">
                      <input type="hidden" id="crbhidden" name="backup">
                      </form>
                    <?php endif ?>
                    
                      <div class="d-flex justify-content-center">
                          <?php if (!empty($backupsList)) : ?>
                            <form id="db" action="admin/delete-backup" method="post">
                                <input type="hidden" id="dbhidden" name="backup">
                                <button type="submit" form="db" class="btn btn-danger mr-2 text-light" role="button" data-toggle="tooltip" data-placement="bottom" title="<?= $t->trans("Remove backup") ?>">
                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                </button>
                            </form>
                          <?php endif ?>
                            <form id="ib" action="admin/import-backup" method="post">
                                <input type="hidden" id="ibhidden" name="backup">
                                <button type="submit" form="ib" class="btn btn-secondary mb-2 mr-2" data-toggle="tooltip" data-placement="bottom" title="<?= $t->trans("Import a backup") ?>">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                </button>
                            </form>
                          <?php if (!empty($backupsList)) : ?>
                            <form id="eb" action="admin/export-backup" method="post">
                                <input type="hidden" id="ebhidden" name="backup">
                                <button type="submit" form="eb" class="btn btn-secondary mr-2" data-toggle="tooltip" data-placement="bottom" title="<?= $t->trans("Export a backup") ?>">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                </button>
                            </form>
                          <?php endif ?>
                            <a href="admin/save-backup" class="btn btn-success mb-2 mr-2 text-light" role="button" data-toggle="tooltip" data-placement="bottom" title="<?= $t->trans("Save backup") ?>">
                              <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                  </div>

        <?php endif ?> 
        
            <!-- Modal confirm delete -->
            <div class="modal" id="confirmRestore">
                <div class="modal-dialog">
                <div class="modal-content shadow">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title"><?= $t->trans('Question?'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <?= $t->trans('How would you like to restore?'); ?>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="submit" form="rmb" class="btn btn-primary" title="<?= $t->trans("Restore & merge backup") ?>"><?= $t->trans("Restore & merge backup") ?></button>
                    <button type="submit" form="crb" class="btn btn-secondary" title="<?= $t->trans("Clear & restore backup") ?>"><?= $t->trans("Clear & restore backup") ?></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $t->trans('Do not do anything'); ?></button>
                    </div>
                    
                </div>
                </div>
            </div>