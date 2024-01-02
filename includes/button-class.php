<?php

require_once 'db_pdo-class.php';

class BUTTON_CSI extends DB_CSI
{

    private $name_button = "diventi";

    function __construct()
    {
    }

    public function modale_start($name_button , $title_modale='' , $type_modale = 'modal-dialog modal-dialog-scrollable')
    {
        $this->name_button = $name_button;

?>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <?php echo $this->name_button ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="<?php echo $type_modale ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $title_modale ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <?php }
                public function modale_end($nome_submit, $testo_submit)
                {


                    ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button  name="<?php echo $nome_submit ?>" type="submit" class="btn btn-primary"><?php echo $testo_submit ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php }

                public function form_start($action = "#", $method = "POST")
                { ?>

        <form  action="<?php echo $action ?>" method="<?php echo $method ?>" class="row mb-3">
        <?php }

                public function submit($nome_submit, $testo_submit)
                { ?>

            <div class="col-12">
                <button name="<?php echo $nome_submit ?>" type="submit" class="btn btn-primary"><?php echo $testo_submit ?></button>
            </div>
        </form>
<?php }
            }


?>